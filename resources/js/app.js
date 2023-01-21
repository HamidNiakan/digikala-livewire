import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


window.addEventListener('livewire:load', () => {
    Livewire.on('destroy', (id) => {
        $('.table').find('#row' + id).remove();
    })

    Livewire.on('toast', (params) => {
        Toast.fire({
            icon: params.icon,
            title: params.title
        })
    })

    Livewire.on('popup-dialog', (params) => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: params.title,
            text: params.text,
            icon: params.icon,
            showCancelButton: false,
            confirmButtonText: 'باشه',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = params.route
            }
        })
    })

    uploadFile()
})


function uploadFile() {
    let progressSection = document.querySelector('#progressBar'),
        progressBar = progressSection.querySelector('.progress-bar');
    let btn = $('#submit');

    document.addEventListener('livewire-upload-start', () => {
        Toast.fire({
            icon: 'info',
            title: 'شروع عملیات آپلود فایل'
        })
        progressSection.style.display = 'flex';
        btn.attr('disabled', true);
    })

    document.addEventListener('livewire-upload-finish', () => {
        Toast.fire({
            icon: 'info',
            title: 'آپلود فایل به اتمام رسید.'
        })
        progressSection.style.display = 'none';
        btn.attr('disabled', false);
    })

    document.addEventListener('livewire-upload-error', () => {
        Toast.fire({
            icon: 'info',
            title: 'آپلود فایل با خطا مواحه شد.'
        })
        progressSection.style.display = 'none';
        btn.attr('disabled', false);
    })

    document.addEventListener('livewire-upload-progress', (event) => {
        progressBar.style.width = `${event.detail.progress}%`;
        progressBar.textContent = `${event.detail.progress}%`;
    })
}