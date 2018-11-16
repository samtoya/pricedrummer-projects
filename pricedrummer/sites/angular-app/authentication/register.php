<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="messages">
                <p class="alert alert-success">You have successfully registered!</p>
                <p class="alert alert-success">Welcome to PriceDrummer</p>
                <p class="alert alert-danger">Oops! Something went wrong, please try again</p>
            </div> <!-- end messages div -->
        </div> <!-- end col-md-12 div -->
    </div> <!-- end row div -->

    <div class="row">
        <div class="col-md-12 col-lg-12 no-padding" style="background-color: #FFFFFF; margin-top: 15px;">
            <div class="col-md-6 no-padding">
                <div class="login-page">
                    <div class="form">
                        <!-- Registration Form -->
                        <form method="post" ng-submit="registration()" novalidate class="register-form" name="registerForm">
                            <div class="col-md-6 no-padding">
                                <input
                                        type="text"
                                        name="firstname"
                                        ng-required="true"
                                        ng-minlength="6"
                                        ng-model="firstname"
                                        placeholder="First Name"/>
                            </div>
                            <div class="col-md-6" style="padding-right: 0;">
                                <input
                                        type="text"
                                        name="lastname"
                                        ng-minlength="6"
                                        ng-required="true"
                                        ng-model="lastname"
                                        placeholder="Last Name"/>
                            </div>
                            <input
                                    type="text"
                                    name="username"
                                    ng-required="true"
                                    ng-model="username"
                                    ng-minlength="6"
                                    placeholder="Username"/>

                            <input
                                    type="email"
                                    name="email"
                                    ng-required="true"
                                    ng-model="email"
                                    ng-minlength="6"
                                    placeholder="Email Address"/>

                            <input
                                    type="password"
                                    ng-required="true"
                                    name="password"
                                    ng-model="password"
                                    placeholder="Password"/>

                            <input
                                    type="password"
                                    ng-required="true"
                                    ng-required="" true
                                    name="confirm_password"
                                    ng-model="confirm_password"
                                    placeholder="Confirm Password"/>

                            <input ng-disabled="registerForm.$invalid" type="submit" name="submit" value="Register">

                            <p class="message">Already registered? <a href="/login">Sign In</a></p>
                        </form>
                    </div><!-- end form div -->
                </div> <!-- end register div -->
            </div> <!-- end col-md-6 div -->

            <div class="col-md-6 col-lg-6"></div>
        </div>
    </div> <!-- end row div -->

</div>