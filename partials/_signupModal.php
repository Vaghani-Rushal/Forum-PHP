<!-- signup Modal -->
<style>
    .hidden {
        display: none;
    }
</style>
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog    ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Signup for an iSecure account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="partials/_handleSignup.php" method="post">
                    <div class="mb-3">
                        <label for="signupUname" class="form-label">User name</label>
                        <input type="text" class="form-control" id="signupUname" name="signupUname" aria-describedby="userHelp" maxlength="30" required>
                        <div id="userHelp" class="form-text">We'll never share your details with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" name="signupPassword" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupCpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupCpassword" name="signupCpassword" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email Address</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" id="signupEmail" placeholder="abc@gmail.com" name="signupEmail" aria-label="signupEmail" aria-describedby="button-addon2" required>
                            <input type="hidden" id="btnClickedValue" name="btnClickedValue" value="" />
                            <button class="btn btn-outline-success" id="sendCodeButton" onclick="sendVerificationCode()" disabled>Send Code</button>
                        </div>
                        <div id="verificationCodeInput" class="hidden input-group mb-3">
                            <label for="verificationCode" class="form-label">Verification Code: </label>
                            <input type="text" class="form-control ml-2" name="verificationInputCode" id="verificationCode" required><br>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">Accept all terms and conditions.</label>
                    </div>

                    <button type="submit" class="btn btn-outline-success">Signup</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    function sendVerificationCode() {

        <?php
        $_SESSION['vcCode'] = rand(100000, 999999);
        ?>

        // Use JavaScript to make an AJAX request to the PHP script
        var userInput = document.getElementById('signupEmail').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mail-sender/sendmail.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                // document.getElementById('result').innerHTML = 'Response from PHP: ' + response;
            }
        };
        xhr.send('userInput=' + encodeURIComponent(userInput));
        // document.getElementById('signupEmail').value = '';

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Email sent successfully!');
            } else {
                alert('Somthing Wrong! Please Try Again Later.');
            }
        };


        // Display the verification code input field
        const verificationCodeInput = document.getElementById("verificationCodeInput");
        verificationCodeInput.classList.remove("hidden");

        // Disable the "Send Verification Code" button
        const sendCodeButton = document.getElementById("sendCodeButton");
        sendCodeButton.disabled = true;
    }

    function isRequiredFieldFilled() {
        return signupEmail.value.trim() !== '';
    }

    // Function to enable/disable the extra button based on field's status
    function toggleExtraButton() {
        sendCodeButton.disabled = !isRequiredFieldFilled();
    }

    signupEmail.addEventListener('input', toggleExtraButton);
</script>