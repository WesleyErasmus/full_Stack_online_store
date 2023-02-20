<template>
  <!-- Home Page Blogs -->

  <!-- Blogs container -->
    <div class="blog-posts-container row">


      <!-- # Blog 1 -->
      <div class="col">
        <a href="https://www.vogue.com/tag/misc/winter-fashion" target="_blank">
          <div class="card text-bg-dark">
            <img
              src="https://images.pexels.com/photos/6567607/pexels-photo-6567607.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              class="card-img"
              alt="..."
            />
            <div class="card-img-overlay">
              <h5 class="card-title-1">#BLOG</h5>
              <h1 class="card-title-2">WINTER TRENDS</h1>
              <p class="blog-description">
                Everything you need to know and shop this winter, from current
                trends, styling tips, outfit ideas, and more.
              </p>
            </div>
          </div>
        </a>
      </div>

      
      <!-- # Blog 2 -->
      <div class="col">
        <a
          href="https://www.vogue.com/article/matching-summer-street-style"
          target="_blank"
        >
          <div class="card text-bg-dark">
            <img
              src="https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
              class="card-img"
              alt="..."
            />
            <div class="card-img-overlay">
              <h5 class="card-title-1">#BLOG</h5>
              <h1 class="card-title-2">MATCHING OUTFITS</h1>
              <p class="blog-description">
                Good things come in twos—or threes, or fours. This is especially
                true when it comes to street style.
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End of blogs container -->
</template>


<style scoped>


/* Link colors [used to override universal links colors] */
a,
.green {
  text-decoration: none;
  color: #000 !important;
  transition: 0.4s;
}
/* Link Hover color */
@media (hover: hover) {
  a:hover {
    color: #000;
  }
}

.card {
  padding: var(--card-padding);
}
/* Blogs */


/* Transparent black filter over blog images */
.card-img-overlay {
  background: rgba(0, 0, 0, 0.54);
  border-radius: 0;
  padding: 2rem;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: column;
}


/* Blog card images */
.card-img {
  border-radius: 0;
}


/* Card column containers */
.col {
  padding: var(--card-padding);
}


/* Card titles that says blogs */
.card-title-1 {
  font-style: italic;
  color: var(--primary-color);
  font-weight: bold;
  font-size: calc(12px + 0.4rem);
}

/* Card blog topic title */
.card-title-2 {
  font-weight: bold;
  font-size: calc(15px + 0.6rem);
}

/* End of Blogs */


/* MEDIA QUERIES */
@media screen and (min-width: 481px) and (max-width: 661px) {
.blog-description {
    display: none;
  }
}


@media screen and (min-width: 0) and (max-width: 480px) {
.card-title-1 {
    font-style: italic;
    color: var(--primary-color);
    font-weight: bold;
    font-size: calc(10px + 0.3rem);
  }

  .card-title-2 {
    font-size: calc(12px + 0.5rem);
    font-weight: bold;
  }

  .blog-description {
    display: none;
  }
}
</style>
