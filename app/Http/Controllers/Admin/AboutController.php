<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Portfolio\SingleData;

/**
 * Class AboutController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс для редактирования данных обо мне.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class AboutController extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request){
        if(!auth()->user()->hasRole('EDIT_ABOUT')) abort(403);

        $about = SingleData::getData('about');

        if($request->isMethod('post')){
            $this->validate($request, [
                'data' => 'required|min:20',
                'img' => 'image|mimes:jpeg,jpg,gif,bmp,png',
                'resume' => 'mimes:pdf',
            ]);
            $data = $request->except(['_token', ]);

            $path = public_path().'/images/';
            $image = $this->saveImage($request->img, $path,
                config('site.author_img'));
            if($image){
                File::delete($path.$about['img']);
                $data['img'] = $image;
            }else{
                $data['img'] = $about['img'];
            }
            $path = public_path().'/';
            $resume = $this->savePDF($request->resume, $path);
            if($resume){
                File::delete($path.$about['resume']);
                $data['resume'] = $resume;
            } else {
                $data['resume'] = $about['resume'];
            }
            $ab = SingleData::setData('about', $data);
            if($ab){
                cache()->forget('about');
                return back()->withInput()
                    ->with('success', 'Данные успешно изменены!');
            }

            return back()
                ->withInput()
                ->withErrors(['all' => 'Что то пошло не так! Повторите '
                    .'попытку позже!']);
        }

        $this->title = 'Обо мне';

        $this->content = view('admin.about')->with([
            'about' => $about,
        ])->render();
        return $this->renderPage();
    }

    /**
     * Сохраняет полученное резюме.
     *
     * @param UploadedFile $pdf
     * @param string $path
     * @return null|string
     */
    protected function savePDF($pdf, string $path){

        if($pdf === null || !$pdf->isValid()) return null;

        $fileName = str_slug(File::name($pdf->getClientOriginalName()))
            .'.'.$pdf->extension();
        $ext = '.' . $pdf->extension();

        while (File::exists($path . $fileName)) {
            $fileName = str_random(config('site.len_name')) . $ext;
        }

        $pdf->move($path, $fileName);

        return $fileName;
    }
}
