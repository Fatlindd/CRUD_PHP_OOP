<?php
// Add a delay (in seconds) for redirection
$redirectDelay = 2;

// Get the current URL
$currentUrl = $_SERVER['PHP_SELF'];

?>
<script>
   // Get the message from PHP and check if it's not empty
    var message = "<?php echo $message; ?>";
    if (message !== "") {
        // Display the message
        var messageContainer = document.createElement("div");
        messageContainer.className = "alert alert-light";
        messageContainer.setAttribute("role", "alert");
        messageContainer.textContent = message;
        messageContainer.style.padding = "10px";
        messageContainer.style.textAlign = "center";

        // Append the message container to the specified element with id "message-container"
        document.getElementById("message-container").appendChild(messageContainer);

        // Hide the message after 3 seconds
        setTimeout(function () {
            messageContainer.style.display = "none";
        }, <?php echo $redirectDelay * 1000; ?>); // Convert seconds to milliseconds

        <?php
            if (basename($_SERVER['PHP_SELF']) == 'index.php') {
        ?>
        // Redirect after form submission to avoid resubmission on page refresh
        setTimeout(function () {
            window.location.href = "<?php echo $currentUrl; ?>";
        }, <?php echo $redirectDelay * 1000; ?>); // Convert seconds to milliseconds
        <?php } ?>
    }
</script>