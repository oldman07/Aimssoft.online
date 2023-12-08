$(document).ready(function () {
  $("#cnic").blur(function () {
    var cnic = $(this).val();

    $.ajax({
      url: "check_cnic.php",
      type: "POST",
      data: { cnic: cnic },
      success: function (response) {
        // Update the error message based on the server response
        $("#cnic-error").text(response);
      },
    });
  });
});
