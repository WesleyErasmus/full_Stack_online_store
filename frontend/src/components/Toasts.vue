<template>
    <!-- These toast messages will appear on user actions success: Product added to cart / product removed from cart / Subscription form submission / Contact us form submission -->

    <div>
    <!-- Add to cart success message -->
    <div id="snackbar">
        <p>Product Successfully Added To Cart!</p>
    </div>


    <!-- Message form submission message -->
    <div id="snackbar2">Your Submission was Successful!
        <p>We'll send you a follow email from us shortly.😊</p>
    </div>


    <!-- Movie successfully added to watch list message -->
    <div id="snackbar3">Product Removed From Cart
    </div>


    <!-- Email subscription form submission message -->
    <div id="snackbar4">Welcome, New Subscriber!
    </div>


    <!-- Sign-up successful message -->
    <div id="snackbar5">Sign-up Successful!
    </div>


    <!-- Sign-up successful message -->
    <div id="snackbar6" style="background-color: red;">Invalid email or password. Please try again.
    </div>
    
    <!-- Profile updated successful message -->
    <div id="snackbar7">Account Details Updated Successfully
    </div>

    </div>
</template>


<style scoped>

p {
    margin-bottom: 0;
    font-weight: bold;
}

/* Toast message styling */
#snackbar,
#snackbar2,
#snackbar3,
#snackbar4,
#snackbar5,
#snackbar6,
#snackbar7
 {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background: #6E14EF;
    color: #fff;
    font-weight: bold;
    text-align: center;
    border-radius: 3px;
    padding: 18px;
    position: fixed;
    z-index: 9999;
    left: 50%;
    bottom: 30px;
    font-size: calc(13px + 0.35rem);
    box-shadow: var(--card-shadows);
}


/* Toasts animation styling below */
#snackbar.show,
#snackbar2.show,
#snackbar3.show,
#snackbar4.show,
#snackbar5.show,
#snackbar6.show,
#snackbar7.show
{
    z-index: 110;
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@-webkit-keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}

@keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}
</style>