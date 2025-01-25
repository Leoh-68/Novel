<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.0 
 * Date 14-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Web;

use NINA\Controllers\Controller;
use Illuminate\Http\Request;
use NINA\Core\Support\Facades\BreadCrumbs;
use NINA\Core\Support\Facades\View;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Email;
use NINA\Models\NewslettersModel;
use NINA\Models\StaticModel;
use NINA\Traits\TraitSave;
use NINA\Core\Support\Facades\Seo;
use Validator;

class ContactController extends  Controller
{
    use TraitSave;
    public function index(Request $request)
    {
        $contact = StaticModel::where('type', 'lienhe')
            ->first();
        $seoPage = $contact->getSeo('static', 'save')->first();
        $seoPage['type'] = 'article';
        BreadCrumbs::setBreadcrumb(type: $this->type, title: 'Liên hệ');
        Seo::setSeoData($seoPage, 'news');
        return View::share(['com' => $this->type])->view('contact.contact', ['contact' => $contact]);
    }
    public function submit(Request $request)
    {
        $responseCaptcha = $_POST['recaptcha_response_contact'];
        $resultCaptcha = Func::checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        $validator = Validator::makeValidate($request, [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng định dạng',
        ]);

        $dataContact = (!empty($request->dataContact)) ? $request->dataContact : null;

        if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'contact') || $testCaptcha == true) {
            foreach ($dataContact as $column => $value) {
                $data[$column] = htmlspecialchars(Func::sanitize($value));
            }

            $data['confirm_status'] = 1;
            $data['status'] = '1';
            $data['date_created'] = time();
            $itemSave = NewslettersModel::create($data);
            if (!empty($itemSave)) {
                $id_insert = $itemSave->id;
                $file = $request->file('file');
                $this->insertImge(NewslettersModel::class, $request, $file, $id_insert, 'file', 'file_attach');

                $arrayEmail = null;
                $subject = (!empty($dataContact['subject'])) ? $dataContact['subject'] : 'Thư liên hệ khách hàng';
                $message = Email::markdown('contact.send', $dataContact);
                $optCompany = json_decode(Func::setting('options'), true);
                $company = Func::setting();
                $file = 'file';

                if (Email::send("admin", $arrayEmail, $subject, $message, $file, $optCompany, $company)) {
                    $arrayEmail = array(
                        "dataEmail" => array(
                            "name" => $dataContact['fullname'],
                            "email" => $dataContact['email']
                        )
                    );

                    Email::send("customer", $arrayEmail, $subject, $message, $file, $optCompany, $company);
                    return transfer('Thông tin liên hệ được gửi thành công.', true, linkReferer());
                } else {
                    return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
                }
            } else {
                return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
            }
        } else {
            return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
        }
    }

    
    public function submitNewsletter(Request $request)
    {

        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        
 
        $resultCaptcha = Func::checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        $validator = Validator::makeValidate($request, [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng định dạng',
        ]);

        $dataNewsletter = (!empty($request->dataNewsletter)) ? $request->dataNewsletter : null;

        if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'newsletter') || $testCaptcha == true) {
            foreach ($dataNewsletter as $column => $value) {
                $data[$column] = htmlspecialchars(Func::sanitize($value));
            }
          
            $data['type'] = 'dang-ky-nhan-tin';
            $data['confirm_status'] = 1;
            $data['status'] = '1';
            $data['date_created'] = time();
            $itemSave = NewslettersModel::create($data);

            if (!empty($itemSave)) {
                $id_insert = $itemSave->id;
                // $file = $request->file('file');
                // $this->insertImge(NewslettersModel::class, $request, $file, $id_insert, 'file', 'file_attach');
                //Email
                // $arrayEmail = null;
                // $subject = (!empty($dataContact['subject'])) ? $dataContact['subject'] : 'Thư liên hệ khách hàng';
                // $message = Email::markdown('contact.send', $dataContact);
                // $optCompany = json_decode(Func::setting('options'), true);
                // $company = Func::setting();
                // $file = 'file';

                // if (Email::send("admin", $arrayEmail, $subject, $message, $file, $optCompany, $company)) {
                //     $arrayEmail = array(
                //         "dataEmail" => array(
                //             "name" => $dataContact['fullname'],
                //             "email" => $dataContact['email']
                //         )
                //     );

                //     Email::send("customer", $arrayEmail, $subject, $message, $file, $optCompany, $company);
                    return transfer('Thông tin liên hệ được gửi thành công.', true, linkReferer());
                // } else {
                //     return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
                // }
            } else {
                return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
            }
        } else {
            return transfer('Thông tin liên hệ được gửi thất bại.', false, linkReferer());
        }
    }

}
