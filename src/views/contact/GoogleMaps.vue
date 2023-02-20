<template>
    <!-- Contact page Google Maps location -->
    <div class="map-container">
        <div class="google-map">

            <!-- Google maps plugin -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13245.459500179782!2d18.41507526406142!3d-33.90600759267591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc6750cf9544a5%3A0x1dc3860578bb4780!2sV%26A%20Waterfront!5e0!3m2!1sen!2sza!4v1659857418654!5m2!1sen!2sza"
                class="google-maps" width="500" height="350" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Company address information from data component-->
        <div class="our-address">
            <h1 class="our-address-title">Where to find us</h1>

            <h4 class="our-address-subtitle">Physical Address:</h4>

            <div class="our-address-company-name">
                {{ BuildingName }}
            </div>

            <div class="our-address-details">
                <span class="material-symbols-outlined primary-color"> location_on </span>
                {{ StreetAddress }}
            </div>

            <div class="our-address-contact-number">
                <span class="material-symbols-outlined primary-color"> call </span>Call us:
                <span>{{ ContactNumber }}</span>
            </div>

            <div class="our-address-email-address">
                <span class="material-symbols-outlined primary-color"> mail </span>Email us:
                <a href="mailto:help@atlas.co.za?">{{ EmailAddress }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // Company address details
            BuildingName: "Atlas Online Fashion | Create Your Look",
            StreetAddress: "V&A Waterfront 19 Dock Rd, Cape Town, 8001",
            ContactNumber: "021 123 1234",
            EmailAddress: "info@atlas.co.za",
        }
    },
}
</script>

<style scoped>


/* Class color assignment */
.primary-color {
    color: var(--primary-color);
}

/* Company Address section */
/* Google maps plugin container */
.map-container {
    background: rgb(230, 230, 230);
    box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
    display: flex;
    justify-content: center;
    padding: 3vw;
    margin-bottom: 5rem;
}

/* Google Maps plugin */
.google-map {
    border: 2px solid #bbb;
    box-shadow: var(--card-shadows);
}

/* Company address details */
.our-address {
    padding: 0 2vw;
}

.our-address-title,
.our-address-subtitle,
.our-address-company-name,
.our-address-details,
.our-address-contact-number,
.our-address-email-address {
    padding: 0 0 0.4vw 0.4vw;
    color: rgb(98, 98, 98);
}

.our-address-title {
    color: #000;
}

.our-address-subtitle {
    padding-top: 2vw;
}

.our-address-company-name {
    font-size: calc(11px + 0.35rem);
    color: #000;
    font-weight: bold;
}

/* Google fonts icons */
.material-symbols-outlined {
    margin-right: 6px;
    position: relative;
    bottom: -5px;
}

/* MEDIA QUERIES */
@media screen and (min-width: 841px) and (max-width: 1280px) {
    .our-address h1 {
        font-size: calc(23px + 0.4rem);
    }

    .google-map,
    .google-maps {
        width: 47vw;
    }

    .our-address-subtitle {
        font-size: calc(12px + 0.4rem);
    }

    .our-address-title,
    .our-address-company-name,
    .our-address-details,
    .our-address-contact-number,
    .our-address-email-address {
        font-size: calc(9px + 0.3rem);
    }


    .our-address-company-name {
        font-size: calc(11px + 0.3rem);
    }
}


@media screen and (min-width: 662px) and (max-width: 840px) {
    .map-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .our-address h1 {
        margin-top: 2rem;
        font-size: calc(21px + 0.4rem);
    }
    .google-map,
    .google-maps {
        width: 85vw;
    }
    .our-address-subtitle {
        font-size: calc(12px + 0.4rem);
    }

    .our-address-title,
    .our-address-company-name,
    .our-address-details,
    .our-address-contact-number,
    .our-address-email-address {
        font-size: calc(9px + 0.2.5rem);
    }


    .our-address-company-name {
        font-size: calc(10px + 0.3rem);
    }
}


@media screen and (min-width: 481px) and (max-width: 661px) {
    .map-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    
        .our-address h1 {
            margin-top: 2rem;
            font-size: calc(21px + 0.4rem);
        }
    
        .google-map,
        .google-maps {
            width: 82vw;
        }
    
        .our-address-subtitle {
            font-size: calc(12px + 0.4rem);
        }
    
        .our-address-title,
        .our-address-company-name,
        .our-address-details,
        .our-address-contact-number,
        .our-address-email-address {
            font-size: calc(9px + 0.2.5rem);
        }
    
    
        .our-address-company-name {
            font-size: calc(10px + 0.3rem);
        }
}


@media screen and (min-width: 0) and (max-width: 480px) {
    .map-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    
        .our-address h1 {
            margin-top: 2rem;
            font-size: calc(21px + 0.4rem);
        }
    
        .google-map,
        .google-maps {
            width: 79vw;
        }
    
        .our-address-subtitle {
            font-size: calc(12px + 0.4rem);
        }
    
        .our-address-title,
        .our-address-company-name,
        .our-address-details,
        .our-address-contact-number,
        .our-address-email-address {
            font-size: calc(9px + 0.2.5rem);
        }
    
    
        .our-address-company-name {
            font-size: calc(10px + 0.3rem);
        }
}
</style>