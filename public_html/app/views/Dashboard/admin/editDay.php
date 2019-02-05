<div class="container">
    <div class="row">
        <div class="col s12 m5">
            <div class="card-panel purple">
                <p class="card-title day-info" data-day-id="<?= $day_id ?>"></p>
                <ul class="white-text lessons-list">
                    <!-- lessons ajax data here -->
                </ul>
                <button title="Добавить предмет" class="btn-floating btn-small add-lesson-button white purple-text right"><i class="material-icons purple-text">add</i></button>
            </div>
        </div>
        <div class="col s12 m6 offset-m1">
            <div class="card-panel panel-edit">
                <div class="success-overlay"></div>
                <div class="success-edit">
                    <p><i class="material-icons">check</i></p>
                </div>
                <p class="card-title black-text" id="lesson-title">Редактирование: Матан</p>
                <form name="edit-day" data-lesson-id="">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="start_time" type="text" class="validate">
                            <label for="start_time">Начало пары</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="end_time" type="text" class="validate">
                            <label for="end_time">Конец пары</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="audithory" type="text" class="validate">
                            <label for="audithory">Аудитория</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <p>
                                <label class="week__checkbox">
                                    <input type="checkbox" id="week1" class="filled-in" />
                                    <span>Числитель</span>
                                </label>
                                <label>
                                    <input type="checkbox" id="week2" class="filled-in" />
                                    <span>Знаменатель</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <button class="btn">Применить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/edit_day.js"></script>