<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Portfolio\Http\Controllers\Controller;

/**
 * Class AdminController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс определяет внешний вид административного раздела сайта.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class AdminController extends Controller {
    //------------------------------------------------------------------------
    //          Описание перемеменных

    /**
     * Заголовок страницы сайта.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Шаблон страницы сайта.
     *
     * @var string
     */
    protected $template = 'admin.template';

    /**
     * Массив переменных которые необходимо передать в страницу шаблона.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Описание ключевых слов для поисковиков на странице.
     *
     * @var string
     */
    protected $keywords = 'shopin';

    /**
     * Основное содержимое страницы.
     *
     * @var string
     */
    protected $content = '';

    /**
     * Дополнительные скрипты и стили страницы.
     *
     * @var string
     */
    protected $head = '';

    /**
     * Дополнительные еденичные скрипты которые необходимо включать перед
     * всеми скриптами.
     * @var string
     */
    protected $firstHead = '';
    //------------------------------------------------------------------------
    //          Функции
    /**
     * AdminController constructor.
     *
     * Конструктор контроллера.
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next){
            if(!auth()->user()->hasRole('VIEW_ADMIN'))
                abort(403);

            return $next($request);
        });
    }

    /**
     * Формирует окончательный вид страницы.
     *
     * @return View
     */
    protected function renderPage(){
        $this->data = array_add($this->data,'title', $this->title);
        $this->data = array_add($this->data, 'keywords', $this->keywords);
        $this->data['first_head'] = $this->firstHead;
        $this->data = array_add($this->data, 'content', $this->content);
        $this->data = array_add($this->data, 'head', $this->head);

        $navigation = view('admin.navigation')->render();
        $this->data['navigation'] = $navigation;

        return view($this->template)->with($this->data);
    }

    /**
     * Сохраняет полученное изображение.
     *
     * @param UploadedFile $image
     * @param string $path
     * @param array $size
     * @return null|string
     */
    protected function saveImage($image, string $path, array $size){
        if($image === null || !$image->isValid()) return null;

        $fileName = str_slug(File::name($image->getClientOriginalName()))
            .'.'.$image->extension();
        $ext = '.' . $image->extension();

        while (File::exists($path . $fileName)) {
            $fileName = str_random(config('site.len_name')) . $ext;
        }

        $img = Image::make($image);
        if ($size && is_array($size)) {
            if($size['width'] !== null && $size['height'] !== null){
                $img->fit($size['width'], $size['height'])
                    ->save($path . $fileName);
            } else {
                $img->resize($size['width'], $size['height'],
                    function ($constraint){
                        $constraint->aspectRatio();
                    })->save($path . $fileName);
            }
        } else {
            $img->save($path . $fileName);
        }

        return $fileName;
    }

    /**
     * Загружает массив изображений.
     *
     * @param array $images
     * @param string $path
     * @param array $size
     * @return array
     */
    protected function multiple_upload(array $images, string $path, array $size){
        $result = [];
        foreach ($images as $image)
            $result[] = $this->saveImage($image, $path, $size);
        return $result;
    }

    /**
     * Формирует массив для выбора пути товаров.
     */
    protected function getArrayGoods($colum = 'path'){
        $categories = $this->getParentCategory();
        $result = [];
        foreach ($categories as $category){
            if($category->getChildren()->count() > 0){
                foreach ($category->getChildren() as $child){
                    $res = $this->getPathGoods($child, $colum);
                    if(count($res) > 0)
                        $result[$child->name] = $res;
                }
            } else{
                $res = $this->getPathGoods($category, $colum);
                if(count($res) > 0)
                    $result[$category->name] = $res;
            }
        }
        return $result;
    }

    /**
     * Возвращает массив товаров категории.
     */
    protected function getPathGoods(Category $category, $colum = 'path'){
        $result = [];
        $goods = Goods::where('category_id', $category->id)
            ->orderBy('updated_at', 'desc')->get();
        foreach ($goods as $good){
            if($colum === 'path')
                $result[$good->url] = $good->name;
            else
                $result[$good->id] = $good->name;
        }

        return $result;
    }
}
