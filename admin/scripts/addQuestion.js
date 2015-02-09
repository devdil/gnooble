
    // AJAX Code Here
$('#addQuestion').click(function() {
    // Okay, we need to get value from textbox name and score
    var questionName = $('#input-qName').val();
    var questionDesc = $('#input-qDesc').val(); // silly me
    var questionInput

    // When user click on the add button
    // Let make a AJAX request
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        type: 'POST', // making a POST request
        data: {
            name: txtname,
            score: txtvalue
        },

        success: function(data) {
            // this function will be trigger when our PHP successfully
            // response (does not mean it will successfully add to database)

            // select the table body
            var row = "<tr>";
            row += "<td>" + data.id + "</td>";
            row += "<td>" + data.name + "</td>";
            row += "<td>" + data.score + "</td>";
            row += "</tr>";

            $('#list tbody').prepend(row);
        }
    })
});

function sort(field) {
    // Making an ajax call to get all information
    $.ajax({
        url: 'ajax-data.php',
        dataType: 'json',
        type: 'POST', // making a POST request
        data: { order: field },
        success: function(data) {
            // let clear the data from the table
            $('#list tbody').html('');

            // fill new data
            for(var i = 0; i < data.length; i++) {
                var row = "<tr>";
                row += "<td>" + data[i].id + "</td>";
                row += "<td>" + data[i].name + "</td>";
                row += "<td>" + data[i].score + "</td>";
                row += "</tr>";

                $('#list tbody').append(row);
            }
        }
    });
}
