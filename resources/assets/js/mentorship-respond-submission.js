$(function () {
    $('#approve-submission').on('click', function () {
        var id = $(this).data('id');
        var button = $(this);
        $(button).attr('disabled', true);
        $(button).text('Processing...');

        fetch(window.appConfig.moodleEnrollUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': window.appConfig.csrfToken
            },
            body: JSON.stringify({ })
            
        })
            .then(res => res.json())
            .then(data => {
                console.log(data)
                $(button).attr('disabled', false);
                $(button).text('Approve Submission');
            })
            .catch(error => {
                console.log("Error: " + data.message)
                $(button).attr('disabled', false);
                $(button).text('Approve Submission');
            });
    })
})