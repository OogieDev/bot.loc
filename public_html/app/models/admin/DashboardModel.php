<?php

namespace app\models\admin;

require_once CORE . '/base/Model.php';
use sys\mali\base\Model;

class DashboardModel extends Model {

    public function getDay($id_day) {

        return \R::findOne('days', 'id = ?', [$id_day]);

    }

    public function getLessons($id_day) {

        return \R::getAll("select * , (select title from days where days.id = days_lessons.id_day) as day_name, (select title from lessons where lessons.id = days_lessons.id_lesson) AS lesson_name FROM days_lessons WHERE id_day = $id_day");

    }

    public function updateDaysLessons($id_day, $id_lesson, $data) {

        \R::exec('DELETE FROM days_lessons WHERE id_day = ? AND id_lesson = ?', [$id_day, $id_lesson]);
        \R::exec("INSERT INTO days_lessons SET id_day = ?, id_lesson = ?, start_time = ?, end_time = ?, audithory = ?, numerator = ?, denomerator = ?", [$id_day, $id_lesson, $data['start_time'], $data['end_time'], $data['audithory'], (int)$data['numerator'], (int)$data['denomerator']]);

    }

}