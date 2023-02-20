<template>
<!-- Contact page wrapper -->
  <div id="main" class="contact-page">


    <!-- Contact page header and header container -->
    <header class="contact-page-header-container">
      <div class="contact-page-header">
        
        <!-- Heading and subheading -->
        <h1>We'd Love To Hear From YOU</h1>
        
        <!-- Subheading -->
        <p class="centered-text-sm">Connect with us on social media</p>  
        
        <!-- Social media links -->
      </div>
      <div class="sm-links">
        <div class="sm-links">
          <a class="sm-icon-item" href="https://www.facebook.com/" target="_blank" alt="Facebook"><i
              class="fa-brands fa-facebook"></i></a>
          <a class="sm-icon-item" href="https://www.twitter.com/" target="_blank" alt="Twitter"><i
              class="fa-brands fa-twitter"></i></a>
          <a class="sm-icon-item" href="https://www.instagram.com/" target="_blank" alt="Instagram"><i
              class="fa-brands fa-instagram"></i></a>
          <a class="sm-icon-item" href="https://www.linkedin.com/" target="_blank" alt="LinkedIn"><i
              class="fa-brands fa-linkedin"></i></a>
          <a class="sm-icon-item" href="https://www.tiktok.com/" target="_blank" alt="TikTok"><i
              class="fa-brands fa-tiktok"></i></a>
          <a class="sm-icon-item" href="https://www.youtube.com/" target="_blank" alt="YouTube"><i
              class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
    </header>

    <!-- Contact page message-us form -->
    <ContactUsForm />

    <!-- Contact page Google Maps location -->
    <GoogleMaps />

    <!-- Company help services number and email address -->
    <div class="need-help-container">
      <h1 class="need-help">Need help?</h1>
      <p>
        Contact our help team on our WhatsApp line
        <a class="help-line-number">{{ HelpLine }}</a> or email <a href="mailto:help@atlas.co.za?">{{ HelpEmail }}</a>.
      </p>
    </div>
  </div>
</template>

<script>
// Components import
import ContactUsForm from "./ContactUsForm.vue"
import GoogleMaps from "./GoogleMaps.vue"
export default {
  components: { ContactUsForm, GoogleMaps },
  name: "Contact",
  data() {
    return {
      // Help services info
      HelpLine: "084 123 1234",
      HelpEmail: "help@atlas.co.za",
    };
  },
};
</script>

<style scoped>

/* Page Header */
header {
  height: 17vw;
  background: #000;
  color: #fff;
  display: flex;
  flex-direction: column;
  align-content: center;
  align-items: center;
  justify-content: center;
  margin: 5rem 0;
  box-shadow: var(--card-shadows);
}


/* Social media header icons */
.centered-text-sm {
  text-align: center;
  color: var(--primary-color);
  font-size: calc(12px + 0.3rem);
  font-weight: bold;
}


/* Social media header icons */
.sm-links {
  padding-top: 1rem;
}


/* Social media header icons */
.sm-icon-item {
  padding: var(--card-padding);
}


/* Social media header icons styling */
.fa-brands {
  font-size: calc(12px + 0.5rem);
  color: #fff;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}


/* Social media header icons hover */
.fa-brands:hover {
  transform: scale(1.5);
  background: none;
  color: var(--primary-color);
}


/* Help services container */
.need-help-container {
  box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
  padding: 2vw;
  background: rgb(230, 230, 230);
}


/* MEDIA QUERIES */
@media screen and (min-width: 841px) and (max-width: 1280px) {
  .contact-page-header-container {
    height: 26vw;
  }

  /* Social media header icons */
  .sm-links {
    padding-top: 0rem;
  }

  /* Help services container */
  .need-help-container {
    padding: 3vw;
  }
}


@media screen and (min-width: 662px) and (max-width: 840px) {
  .contact-page-header-container {
    height: 33vw;
  }

  /* Social media header icons */
  .sm-links {
    padding-top: 0rem;
  }

  /* Help services container */
  .need-help-container {
    padding: 4vw;
  }
}


@media screen and (min-width: 481px) and (max-width: 661px) {
  .contact-page-header-container {
    height: 43vw;
  }

  header h1 {
    font-size: calc(20px + 0.3rem);
  }

  /* Social media header icons */
  .sm-links {
    padding-top: 0rem;
  }

  /* Help services container */
  .need-help-container {
    padding: 4vw;
  }

  .need-help-container h1 {
    font-size: calc(20px + 0.3rem);
  }
}


@media screen and (min-width: 0) and (max-width: 480px) {
  .contact-page-header-container {
    height: 43vw;
  }

  header h1 {
    font-size: calc(20px + 0.3rem);
  }

  /* Social media header icons */
  .sm-links {
    padding-top: 0rem;
  }

  /* Help services container */
  .need-help-container {
    padding: 4vw;
  }

  .need-help-container h1 {
    font-size: calc(20px + 0.3rem);
  }

}
</style>
