let day = null;
let lessons = [];



$(document).ready(function () {
    // init app
    initPage();

    $('form[name="edit-day"]').submit(sendForm);
    $('.lessons-list__item.edit').click(deleteOrEditLessonItem);
});

function initPage() {
    $.ajax({
        url: '/admin/dashboard/edit-day-get-data',
        method: 'GET',
        data: {day: $('.day-info').data('dayId')},
        success: function (data) {
            let parseData = JSON.parse(data);
            day = parseData['day'];
            lessons = parseData['lessons'];
            console.log(lessons);
            // adding items to html list
            startApp();
        },
        error: function (data) {
            console.log('error! ' + data);
        }
    });
}

function startApp() {
    fillingDay();
    $('.lessons-list__item.edit').click(deleteOrEditLessonItem);
}

function fillingDay() {
    if (lessons.length > 0) {
        list = $('.lessons-list');
        $('.day-info').text(day.title);
        for (let i = 0; i < lessons.length; i++) {
            let item = document.createElement('li');
            item.className = 'lessons-list__item edit';
            item.setAttribute('data-lesson-id', lessons[i].id_lesson);

            let itemContentContainer = document.createElement('div');
            itemContentContainer.className = 'lessons-list__item__content';
            itemContentContainer.textContent = lessons[i].lesson_name;

            let itemContentIcons = document.createElement('div');
            itemContentIcons.className = 'lessons-list__item__icons';

            let editIcon = document.createElement('i');
            editIcon.className = 'material-icons purple-text item-edit';
            editIcon.textContent = 'edit';

            let deleteIcon = document.createElement('i');
            deleteIcon.className = 'material-icons purple-text item-delete';
            deleteIcon.textContent = 'clear';

            itemContentIcons.appendChild(editIcon);
            itemContentIcons.appendChild(deleteIcon);

            item.appendChild(itemContentContainer);
            item.appendChild(itemContentIcons);
            list.append(item);
        }
    }
}

// delete or edit action
function deleteOrEditLessonItem(e) {
    if (e.target.classList.contains('item-delete')) {
        let isDelete = confirm('Удалить предмет ' + this.querySelector('.lessons-list__item__content').textContent + "?");
        if (isDelete) {
            this.remove();
        }
    }
    else if (e.target.classList.contains('item-edit')) {
        let id = this.dataset['lessonId'];
        let item = null;
        for (let i = 0; i < lessons.length; i++) {
            if (id == lessons[i].id_lesson) {
                item = lessons[i];
                break;
            }
        }
        if (item) {
            showEditForm(
                id,
                item.lesson_name,
                item.start_time,
                item.end_time,
                item.audithory,
                item.numerator,
                item.denomerator
            )
        }
    }
}

function showEditForm(id, title, startTime, endTime, audithory, numerator, denominator) {
    let panel = $('.panel-edit');

    // set data-lesson-id to form
    $(panel).find('form').attr('data-lesson-id', id);

    let panelTitle = $(panel).find('#lesson-title');
    let panelStartTime = $(panel).find('#start_time');
    let panelEndTime = $(panel).find('#end_time');
    let panelAudithory = $(panel).find('#audithory');
    let panelWeek1 = $(panel).find('#week1');
    let panelWeek2 = $(panel).find('#week2');

    panel.find('label').addClass('active');

    panelTitle.text("Редактирование: " + title);
    panelStartTime.val(startTime);
    panelEndTime.val(endTime);
    panelAudithory.val(audithory);

    panelWeek1.prop('checked', false);
    panelWeek2.prop('checked', false);


    if (numerator == "1") {
        panelWeek1.prop('checked', true);
    }
    if (denominator == "1") {
        panelWeek2.prop('checked', true);
    }

    panel.fadeIn();
}


function sendForm(e) {
    e.preventDefault();
    let id_lesson = this.dataset['lessonId'];
    let start_time = this.elements['start_time'];
    let end_time = this.elements['end_time'];
    let audithory = this.elements['audithory'];
    let numerator = this.elements['week1'].checked ? 1 : 0;
    let denominator = this.elements['week2'].checked ? 1 : 0;

    let errors = false;

    if (!validateTime(start_time.value)) {
        errors = true;
        start_time.classList.add('invalid');
        setTimeout(function () {
            start_time.classList.remove('invalid');
        }, 2000);
    }
    if (!validateTime(end_time.value)) {
        errors = true;
        end_time.classList.add('invalid');
        setTimeout(function () {
            end_time.classList.remove('invalid');
        }, 2000);
    }

    if (!errors) {
        sendAjax('/admin/dashboard/move-data', {id_day: day.id, id_lesson: id_lesson,  start_time: start_time.value, end_time: end_time.value, audithory: audithory.value, numerator: numerator, denomerator: denominator}, successAjax, errorAjax)
        editLessons(id_lesson, start_time.value, end_time.value, audithory.value, numerator, denominator)
    }
}

function editLessons(id_lesson, start_time, end_time, audithory, numerator, denominator) {

    for (let i = 0; i < lessons.length; i++) {

        if (lessons[i].id_lesson == id_lesson) {
            lessons[i].start_time = start_time;
            lessons[i].end_time = end_time;
            lessons[i].audithory = audithory;
            lessons[i].numerator = numerator;
            lessons[i].denomerator = denominator;
            break;
        }

    }

}

function successAjax(data) {
    $('.success-overlay').fadeIn();
    $('.success-edit').fadeIn();
    setTimeout(function () {
        $('.panel-edit').fadeOut();
    }, 1000);
    setTimeout(function () {
        $('.success-overlay').fadeOut();
        $('.success-edit').fadeOut();
    }, 1500);
    console.log(data);
}
function errorAjax(data) {
    console.log(data);
}

function sendAjax(url, data, success, error) {
    $.ajax({
        url: url,
        method: "post",
        data: data,
        success: success,
        error: error
    });
}

function validateTime(time) {

    if (!time.match('^[0-9]{1,2}:[0-9]{1,2}$')) {
        return false;
    }
    return true;

}