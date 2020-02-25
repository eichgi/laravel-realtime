require('./bootstrap');

Echo.private('notifications')
    .listen('UserSessionChanged', e => {
        const notificationElement = document.querySelector('#notification');
        notificationElement.innerText = e.message;
        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-sucess');
        notificationElement.classList.remove('alert-danger');
        notificationElement.classList.add('alert-' + e.type);
    });
