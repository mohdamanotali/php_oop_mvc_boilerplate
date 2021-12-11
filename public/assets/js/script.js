$(document).ready(function(){
    $('form').attr({method: 'post', action: $('#add-route').val()});
    $('button[type=reset]').on('click', function() {
        $('.opt-label').text('Add New');
        $('.btn-label').text('Save');
        $('form').attr({method: 'post', action: $('#add-route').val()});
        $('.edit-btn').prop('disabled', false);
    });
    $('.edit-btn').on('click', function() {
        $(this).prop('disabled', true);
        $('.opt-label').text('Edit Data');
        $('.btn-label').text('Update');
        $('form').attr({method: 'post', action: $('#edit-route').val()});

        var data = JSON.parse($(this).attr('data-obj'));
        $('input[name=id]').val(data.id);
        $('input[name=player_name]').val(data.player_name);
        $('select[name=sport_name]').val(data.sport_name);
        $('input[name=total_usd]').val(data.total_usd);
        $('input[name=on_usd]').val(data.on_usd);
        $('input[name=off_usd]').val(data.off_usd);
    });
    $('.del-btn').on('click', function() {
        if (confirm('Are you sure?')) {
            $('form').get(0).reset();
            $('form').attr({method: 'get', action: $('#delete-route').val()+'/'+$(this).attr('data-id')}).submit();
        } else {
            $('button[type=reset]').click();
        }
    });
    $('.float-number-only').on('input', function() {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    });
    setTimeout(function() {
        var alert = document.getElementById("alert");
        alert.remove();
    }, 2000);
});