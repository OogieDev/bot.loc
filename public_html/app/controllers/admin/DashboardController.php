<?php
namespace app\controllers\admin;

require_once APP . '/controllers/Base.php';
use app\controllers\Base;

class DashboardController extends Base {

    public function indexAction() {

        $this->checkLogin();
        $this->data['nav_active'] = 'day';

    }

    public function editLessonAction() {

        $this->checkLogin();
        $this->data['nav_active'] = 'lesson';

    }

    public function editDayAction() {
        // isLogged
        $this->checkLogin();

        if (isset($_GET['day']) && !empty($_GET['day'])) {
            $this->data['day_id'] = $_GET['day'];
        }
    }

    public function moveDataAction() {

        // isLogged
        $this->checkLogin();

        // isAjax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if ($_SERVER['REQUEST_METHOD'] == "POST" && $this->validate()) {

                $this->self_model->updateDaysLessons($_POST['id_day'], $_POST['id_lesson'], $_POST);
                die('success');

            } else {
                throw new \Exception('Not enaph data', 500);
            }
        }
        header('Location: /admin/');
    }

    private function validate() {

        $error = false;

        if (!isset($_POST['id_day']) || empty($_POST['id_day'])) {
            $error = true;
        }

        if (!isset($_POST['id_lesson']) || empty($_POST['id_lesson'])) {
            $error = true;
        }

        if (mb_strlen($_GET['start_time']) > 50 || mb_strlen($_GET['start_time']) < 0) {
            $error = true;
        }

        if (mb_strlen($_GET['end_time']) > 50 || mb_strlen($_GET['end_time']) < 0) {
            $error = true;
        }

        if (mb_strlen($_GET['audithory']) > 255 || mb_strlen($_GET['audithory']) < 0) {
            $error = true;
        }

        return !$error;

    }

    public function editDayGetDataAction() {

        // isLogged
        $this->checkLogin();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (isset($_GET['day']) && !empty($_GET['day'])) {
                $id_day = $_GET['day'];

                $day = $this->self_model->getDay($id_day);
                $lessons = $this->self_model->getLessons($id_day);


                die(json_encode(['day' => $day, 'lessons' => $lessons]));
            }
        }

        header('Location: /admin');

    }

}