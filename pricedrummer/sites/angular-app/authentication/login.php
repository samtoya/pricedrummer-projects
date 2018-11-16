<div class="container">
    <div class="row">
        <div class="col md-12">
            <div id="messages">
                <p class="alert alert-success">You have successfully registered!</p>
                <p class="alert alert-success">Welcome to PriceDrummer</p>
                <p class="alert alert-danger">Oops! Something went wrong, please try again</p>
            </div> <!-- end messages div -->
        </div> <!-- end col-md-12 div -->
    </div> <!-- end row div -->
    
    <div class="row">
        <div class="col-lg-12 col-md-12 no-padding" style="background-color: #FFFFFF; margin-top: 15px;">
            <div class="col-md-6 no-padding">
                <div class="login-page">
                    <div class="form">
                        <!-- Login form -->
                        <form ng-submit="login()" novalidate class="login-form" name="loginForm">
                            <input
                                    autofocus
                                    type="text"
                                    name="username"
                                    ng-required="true"
                                    ng-model="username"
                                    ng-minlength="6"
                                    placeholder="Username"/>

                            <input
                                    type="password"
                                    name="password"
                                    ng-model="password"
                                    ng-required="true"
                                    placeholder="Password"/>

                            <input ng-disabled="loginForm.$invalid" type="submit" name="submit" value="Login">
                            <p class="message">New customer? <a href="/register">Create an account</a></p>
                        </form>
                    </div><!-- end form div -->
                </div> <!-- end login page div -->
            </div> <!-- end col-md-6 div -->
            <div class="col-md-6"></div> <!-- end col-md-6 div -->
        </div>
    </div> <!-- end row div -->
</div>