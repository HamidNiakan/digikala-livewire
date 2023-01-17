window.addEventListener('destroy', event => {
    let id = event.detail.id;
    $('.table').find('#row'+id).remove();
})