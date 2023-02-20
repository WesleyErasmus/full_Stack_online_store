<template>
    <!-- These toast messages will appear on user actions success: Product added to cart / product removed from cart / Subscription form submission / Contact us form submission -->

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
</template>


<style scoped>
/* Change link / router-link font color */
a,
.green {
    text-decoration: none;
    color:#fff;
    transition: 0.4s;
    text-decoration: underline;
}
/* :ink hover color */
@media (hover: hover) {
    a:hover {
        color: #000;
    }
}

p {
    margin-bottom: 0;
    font-weight: bold;
}

/* Toast message styling */
#snackbar,
#snackbar2,
#snackbar3,
#snackbar4
 {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background: var(--primary-color);
    color: #fff;
    font-weight: bold;
    text-align: center;
    border-radius: 3px;
    padding: 18px;
    position: fixed;
    z-index: 110;
    left: 50%;
    bottom: 30px;
    font-size: calc(13px + 0.35rem);
    box-shadow: var(--card-shadows);
}


/* Toasts animation styling below */
#snackbar.show,
#snackbar2.show,
#snackbar3.show,
#snackbar4.show {
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