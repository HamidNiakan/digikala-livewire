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



window.addEventListener('livewire:load',() => {
    Livewire.on('destroy',(id) => {
        $('.table').find('#row'+id).remove();
    })

    Livewire.on('toast',(params) => {
        Toast.fire({
            icon: params.icon,
            title: params.title
        })
    })
})