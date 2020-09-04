const root = document.currentScript.getAttribute('root');
$(function(){
    let displayData = [];
    let page = 0;
    let limit = 15;
    let count = 30;
    const setStatusMsg = (status, msg)=>{
        $('#statusMsg').attr('class', status);
        $('#statusMsg').text(msg);
    }

    $('#createTableBtn').click(function(){
        setStatusMsg('', 'creating tables...');
        $.ajax(`${root}/createtable.php`)
        .done(function(){
            setStatusMsg('success', 'Tables created successfully!');
        })
        .fail(function(){
            setStatusMsg('error', 'Failed to create Tables');
        });
    });

    $('#importCsvBtn').click(function(){
        $('#fileUpload').click();
    });

    $('#fileUpload').change(function(){
        $('#fileUploadForm').submit();
    });

    $('#fileUploadForm').submit(function(e){
        e.preventDefault();
        setStatusMsg('', 'importing File...');
        const formData = new FormData($('form')[0]);
        $('#fileUpload').val('');
        $.ajax({
            url: `${root}/importfile.php`,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
        })
        .done(function(data){
            setStatusMsg('success', 'File Imported successfully!');
        })
        .fail(function(err){
            setStatusMsg('error', err.responseText);
        });
    });

    $('#saveBtn').click(function(){
        setStatusMsg('', 'Saving File...');
        $.ajax(`${root}/save.php`)
        .done(function(data){
            getData();
            setStatusMsg('success', 'File Saved successfully!');
        })
        .fail(function(err){
            setStatusMsg('error', err.responseText);
        });
    });

    $('#clearBtn').click(function(){
        setStatusMsg('', 'clearing...');
        $.ajax(`${root}/clear.php`)
        .done(function(){
            $('#table').empty();
            displayData=[];
            page=0;
            $('#page').text('');
            setStatusMsg('success', 'cleared successfully!');

        })
        .fail(function(err){
            setStatusMsg('error', err.responseText);
        });
    });

    const display = ()=>{
        $('#table').empty();
        const selected = $('#select').val();
        if(selected === 'users'){
            $('#table').append("<tr><th>id</th><th>name</th></tr>");
            displayData.forEach(user=>{
                $('#table').append(`<tr><td>${user.id}</td><td>${user.name}</td></tr>`);
            });
        }else if(selected === 'deals'){
            $('#table').append("<tr><th>id</th><th>name</th></tr>");
            displayData.forEach(deal=>{
                $('#table').append(`<tr><td>${deal.id}</td><td>${deal.name}</td></tr>`);
            });
        }else{
            $('#table').append("<tr><th>user id</th><th>deal id</th><th>hour</th><th>accept</th><th>refuse</th></tr>");
            displayData.forEach(ud=>{
                $('#table').append(`<tr><td>${ud.user_id}</td><td>${ud.deal_id}</td><td>${ud.hour}</td><td>${ud.accept}</td><td>${ud.refuse}</td></tr>`);
            });
        }
    };

    const getData = ()=>{
        const selected = $('select').val();
        $.ajax(`${root}/getdata.php?s=${selected}&limit=${limit}&page=${page}`)
        .done(function(data){
            const parsedData = $.parseJSON(data);
            displayData = parsedData.data;
            count = parsedData.count[0].count;
            $('#page').text(`${page+1} of ${Math.ceil(count/limit)}`);
            display();
        });
    };

    $('#select').change(function(){
        page=0;
        getData();
    });

    $('#next').click(function(){
        if((page+1)*limit < count){
            page++;
            getData();
        }
    });
    $('#prev').click(function(){
        if(page>0){
            page--;
            getData();
        }
    });

    getData();

});