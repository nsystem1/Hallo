var errors = {};
var etypes = ['serror', 'uerror', 'eerror', 'perror', 'pcerror'];

function checkUsername(username) {
    if (/[^a-zA-Z0-9_-]/.test(username)) {
        errors['uerror'] = "Must be alphanumeric and may only contain _ or -.";
    } else if (username.length < 4) {
        errors['uerror'] = "Must be at least 4 characters long.";
    }
}

function checkEmail(email) {
    if (!isValidEmail(email)) {
        errors['eerror'] = "Invalid email address.";
    }
}

function checkPassword(password) {
    if (/[\s\t]/.test(password)) {
        errors['perror'] = "Cannot contain empty spaces.";
    } else if (password.length < 4) {
        errors['perror'] = "Must be at least 4 characters long.";
    }
}

function updateErrors(container) {
    var handle = (container?container:"") + " .error#";
    for (var i in etypes) {
        var et = etypes[i];
        if (errors && errors.hasOwnProperty(et)) {
            $(handle + et).text(errors[et]);
        } else {
            $(handle + et).text(null);
        }
    }
}

function isValidEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function dispWaiting(id) {
    $('.subblock#' + id + ' .loading').css('visibility', 'visible');
    $('.subblock#' + id + ' .sbtn').css('visibility', 'hidden');
}

function stopWaiting(id) {
    $('.subblock#' + id + ' .loading').css('visibility', 'hidden');
    $('.subblock#' + id + ' .sbtn').css('visibility', 'visible');
}
