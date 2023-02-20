<template>
  <div id="main" class="about">
    <!-- About company -->
    <div class="about-company">
      <div class="about-company-heading">
        <h1>Who We Are</h1>
      </div>


      <!-- Company profile text container -->
      <div class="company-bio-container">
        <p class="company-bio-pt1">
          It was a simple tip of the hat. Grace didn't think that anyone else besides her had even noticed it. It wasn't
          anything that the average person would notice, let alone remember at the end of the day. That's why it seemed
          so unbelievable that this little gesture would ultimately change the course of the world.
        </p>
        <p class="company-bio-pt2">
          The light was out on the front porch of the house. This was strange. Judy couldn't remember a time when she
          had ever seen it out. She hopped out of her car and walked to the door. It was slightly ajar and she knew this
          meant something terrible. She gently pushed the door open and hall her fears were realized. "Surprise! Happy
          Birthday!" everyone shouted.
        </p>
      </div>
    </div>

    
    <!-- Team members -->
    <div class="meet-the-team-header">
      <h6>Meet</h6>
      <h1>The Team</h1>
    </div>


    <!-- Team members for loop -->
      <!-- Team member cards wrapper -->
      <div v-if="team.length" class="flip-card-wrapper">
        <div class="flip-card-container">
          <div v-for="member in team" :key="member.id">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <img class="flip-card-img" :src="member.portrait" alt="Team Member Image">
                </div>
                <div class="flip-card-back">
                  <h1>{{ member.name }}</h1>
                  <p class="flip-card-job-title-text">{{ member.job_title }}</p>
                  <p>{{ member.bio }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of card wrapper -->


    <!-- Page loading spinner -->
    <div v-else>
      <Spinner />
    </div>

    
    <!-- Endorsements Wrapper -->
    <div class="endorsements-wrapper">
      <div class="logo-container">
        <img class="logo-image" src="../assets/logowords.png" alt="Logo-Words">
      </div>

    
    <!-- Google fonts icon -->
      <span class="material-symbols-outlined"> thumb_up_off </span>

    
    <!-- Endorsements comments container -->
      <div class="customer-endorsements-container"></div>

      <div class="endorsement-comment">
        "It's just amazing. Atlas Fashion has got everything I need. The service was
        excellent. I'd be lost without Atlas fashion." <span class="endorser-name"> - Aub P.</span>
      </div>

      <div class="endorsement-comment">
        "It's just amazing. We can't understand how we've been living without
        you." <span class="endorser-name"> - Lurline C.</span>
      </div>

      <div class="endorsement-comment">
        "I can't say enough about your store. It really saves me time and
        effort. Your store is exactly what I have been looking for. I love your
        store." <span class="endorser-name"> - Shanie E.</span>
      </div>

      <div class="endorsement-comment">
        "Great job, I will definitely be ordering again! Your company is truly
        upstanding and is behind its products 100%." <span class="endorser-name"> - Ruby Z.</span>
      </div>
    </div>
  </div>


</template>

<script>
// Page loading spinner component
import Spinner from "/src/components/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      // Array containing team member info
      team: [],
    };
  },
  mounted() {
    // Fetch team members data from local json data file
    fetch("../src/data/team.json")
      .then((res) => res.json())
      .then((data) => (this.team = data.team))
      .catch((err) => console.log(err.message));
  },
};
</script>

<style scoped>

/* About company profile container */
.about-company {
  padding: 5rem 0;
  text-align: center;
}

/* About Page heading */
.about-company-heading {
  display: flex;
  flex-direction: column;
  align-content: center;
  align-items: center;
  justify-content: center;
  background: #000;
  padding: 4.5vw;
  color: #fff;
}
/* Google fonts thumbs up icon */
.material-symbols-outlined {
  color: var(--primary-color);
}

/* Profile text container */
.company-bio-container {
  color: #000;
  padding: 3vw;
  font-size: calc(11px + 0.35rem);
  box-shadow: var(--card-shadows);
}

/* Company Profile text container */
.company-bio-pt1 {
  margin-bottom: 1.5vw;
}

/* Meet the team styling */
/* Meet the team container header */
.meet-the-team-header {
  display: block;
  margin: 0 auto;
  text-align: center;
}

/* Meet the team flip card wrapper */
.flip-card-wrapper {
  max-width: 1280px;
  display: block;
  margin: 0 auto;
  margin-bottom: 5rem;
}

.flip-card-container {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  align-content: center;
  align-items: center;

}
/* Contains image and card content */
.flip-card {
  padding: var(--card-padding);
  background-color: transparent;
  width: calc(261px + 8vw);
  height: calc(470px + 8vw);
  /* https: //developer.mozilla.org/en-US/docs/Web/CSS/transform-function/perspective */
  perspective: 1000px;
}

.flip-card-img {
  aspect-ratio: 2 / 3;
  width: 100%;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  /* https: //developer.mozilla.org/en-US/docs/Web/CSS/transform-style */
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front,
.flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: center;
  align-content: center;
  align-items: center;
}

/* Contains team member image */
.flip-card-front {
  background-color: transparent;
  color: black;
}
/* Contains team member info */
.flip-card-back {
  font-size: calc(10px + 0.4rem);
  background: var(--primary-color);
  color: #000;
  transform: rotateY(180deg);
  padding: var(--card-padding);
}

.flip-card-job-title-text {
  color: #fff;
  font-weight: bold;
}

/* Customer endorsements styling */
.endorsements-wrapper {
  text-align: center;
  font-size: calc(13px + 0.3rem);
  padding: 4vw;
  background: rgb(223, 223, 223);
  box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
}

/* Logo at customer endorsements */
.logo-container {
  margin-bottom: 1rem;
}

/* Google fonts icon for endorsements header */
.material-symbols-outlined {
  font-size: 32px;
  margin-left: 9px;
  position: relative;
  bottom: -4px;
  margin-right: 13px;
}

/* Endorsement comment containers */
.endorsement-comment {
  border-radius: 7px;
  padding: var(--card-padding);
  font-size: calc(13px + 0.3rem);
}

.endorser-name {
  color: var(--primary-color);
  font-weight: bold;
  font-size: calc(12px + 0.3rem);
}

/* MEDIA QUERIES */
@media screen and (min-width: 841px) and (max-width: 1280px) {
  .company-bio-container {
    font-size: calc(11px + 0.35rem);

  }

  .endorsement-comment {
    font-size: calc(11px + 0.3rem);
  }

  .endorser-name {
    font-size: calc(12px + 0.3rem);
  }
}


@media screen and (min-width: 662px) and (max-width: 840px) {
  .company-bio-container {
    font-size: calc(10px + 0.3rem);

  }

  .card-text {
    font-size: calc(9px + 0.3rem);
  }

  .endorsement-comment {

    border-radius: 0;
    font-size: calc(9px + 0.3rem);
    border-bottom: 1px solid rgb(187, 187, 187);
  }

  .endorser-name {
    font-size: calc(10px + 0.3rem);
  }
}


@media screen and (min-width: 481px) and (max-width: 661px) {
  .company-bio-container {
    font-size: calc(10px + 0.3rem);

  }

  .card-title {
    min-height: 0;
  }

  .card-text {
    font-size: calc(9px + 0.3rem);
  }

  .card-description {
    display: none;
  }

  .endorsement-comment {
    border-radius: 0;
    font-size: calc(9px + 0.3rem);
    border-bottom: 1px solid rgb(187, 187, 187);
    margin: var(--card-padding);
  }

  .endorser-name {
    font-size: calc(10px + 0.3rem);
  }
}


@media screen and (min-width: 0) and (max-width: 480px) {
  .company-bio-container {
    font-size: calc(10px + 0.3rem);

  }

  .card-title {
    min-height: 0;
  }

  .card-text {
    font-size: calc(9px + 0.3rem);
  }

  .card-description {
    display: none;
  }

  .endorsement-comment {
    border-radius: 0;
    font-size: calc(9px + 0.3rem);
    border-bottom: 1px solid rgb(187, 187, 187);
    margin: var(--card-padding);
  }

  .endorser-name {
    font-size: calc(10px + 0.3rem);
  }
}
</style>
