window.onload = function (ev) {
    var name = document.querySelector('input[name=name]');
    var lastName = document.querySelector('input[name=lastName]');
    var submit = document.querySelector('.submit');


    submit.onsubmit = function (e) {
        if (/\d/.test(name.value)) {
            name.classList.add("input-default");
            name.focus();
			alert("Не может быть чисел!")
            e.preventDefault();
        } else if (/\d/.test(lastName.value)) {
            if (name.classList.contains("input-default")) name.classList.remove("input-default");
            lastName.classList.add("input-default");
            lastName.focus();
            e.preventDefault();
        }
        return true;
    }
}