$(document).ready(function () {
    $("#submit").click(function (e) {
        e.preventDefault();
        var formdata = new FormData()
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var img = $('#img').get(0).files
        for (var i = 0; i < img.length; i++) {
            formdata.append("file[]", img[i]);
        }
        var video = $('#video').get(0).files
        for (var i = 0; i < video.length; i++) {
            formdata.append("file[]", video[i]);
        }
        formdata.append('name', name)
        formdata.append('email', email)
        formdata.append('password', password)
        $.ajax({
            type: 'POST',
            url: "/pagination/add",
            data: formdata,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function () {
                $('table').load(location.href + ' .table')
            }
        });
    });
    $(document).on("click", ".delete", function (e) {
        e.preventDefault();
        var id = ($(this).attr("id")).slice(7);
        var url = ('/delete/' + id).slice(0, 10)
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                '_method': 'delete'
            },
            success: function () {
                $('table').load(location.href + ' .table')
            }
        });
    });

    $(document).on("click", ".edit", function (e) {
        e.preventDefault();
        var id = ($(this).attr("id")).slice(5);
        var url = ('/edit/' + id).slice(0, 8)
        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
                $('#name_edit').val(response.user.Name);
                $('#email_edit').val(response.user.Email);
                $('#password_edit').val(response.user.Password);
                $('#id_edit').val(response.user.id);
            }
        });
    });

    $(document).on("click", ".update", function (e) {
        e.preventDefault();
        var id = $("#id_edit").val()
        var url = ('/update/' + id).slice(0, 10)
        var formedit = new FormData()
        var name = $("#name_edit").val();
        var email = $("#email_edit").val();
        var password = $("#password_edit").val();
        var imgedit = $('#img_edit').get(0).files
        for (var i = 0; i < imgedit.length; i++) {
            formedit.append("files[]", imgedit[i]);
        }
        var videoedit = $('#video_edit').get(0).files
        for (var i = 0; i < imgedit.length; i++) {
            formedit.append("files[]", videoedit[i]);
        }
        formedit.append('name', name)
        formedit.append('email', email)
        formedit.append('password', password)
        formedit.append('_method', 'post')
        $.ajax({
            type: 'post',
            url: url,
            data: formedit,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function () {
                $('table').load(location.href + ' .table')
            }
        });
    });
    function pagination(page) {
        $.ajax({
            url: "/pagination/paginate?page=" + page,
            success: function (data) {
                $('table').html(data)
            }
        })
    }
    $(document).on("keyup", function (e) {
        e.preventDefault()
        var search = $("#search").val();
        $.ajax({
            method: "GET",
            url: "/search",
            data: { 'search': search },
            success: function (data) {
                $('table').html(data)
                if (data.status == 'khong co du lieu tim kiem') {
                    $('table').html('<span class="text-danger">khong co du lieu tim kiem</span>')
                }
            }
        })
    })
})