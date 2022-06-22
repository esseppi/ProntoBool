<template>
<v-main>
    <div class="inner">
        <div class="profile-data">
            
            <!-- PROFILE -->
            <section>
                <div class="prof-flex">
                    <div class="profile-image">
                        <img :src="profileData.pic" :alt="profileData.name">
                    </div>
                    <div class="data-flex">
                        <div class="profile-info">
                            <h1 class="profile-name">{{ profileData.name }}</h1>
                            <p class="profile-address">{{ profileData.address }}</p>
                            <div class="badge-container">
                                <span class="badge" v-for="(item, index) in profileData.professions" :key="index">{{ item }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="ul-info">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Curriculum</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">Location</a></li>
                </ul>
            </section>

            <!-- ABOUT -->
            <section class="about">
                <h2>About {{ profileData.name }}</h2>
                <p>{{ profileData.description }}</p>
            </section>

            <!-- CURRICULUM -->
            <section class="curriculum">
                <h2>Curriculum Vitae</h2>
                <div class="card"></div>
            </section>

            <!-- REVIEWS -->
            <section>
            <h2>{{ profileReviews.length }} Reviews</h2>
                <div class="banner">
                <div class="icon-container"> <v-icon class="icon">mdi-information-outline</v-icon> </div>
                <p>Your trust is our top concern, so providers can't pay to alter or remove reviews. We also don't publish reviews that contain any private information.</p>
                </div>
                <div class="reviews-top-container">
                    <div class="">
                        <h4>Overall rating</h4>
                        <div class="vote">{{ profileData.vote }}</div>
                    </div>
                    <div class="">
                        <button class="btn">Write a review</button>
                    </div>
                </div>
                <div class="reviews-bottom-container">
                    <div v-for="(item, index) in profileReviews.slice(0, reviewsShowed)" :key="index" class="review">
                        <div class="star">
                            <ul>
                                <li v-for="ind in Math.floor(item.vote)" :key="'star-'+index+'-'+ind">
                                    <v-icon class="star-color">mdi-star</v-icon>
                                </li>
                                <li v-for="ind in 5 - Math.floor(item.vote)" :key="'star-void-'+index+'-'+ind">
                                    <v-icon class="star-color">mdi-star-outline</v-icon>
                                </li>
                            </ul>
                        </div>
                        <p>{{ item.message }}</p>
                        <div class="reviews-info">
                            <span>{{ item.name }}</span> • 
                            <span>{{ item.date }}</span>
                        </div>
                    </div>
                    <button @click="reviewsShowed+=5" v-if="reviewsShowed <= profileReviews.length" class="btn outlined">See more</button>
                </div>
            </section>
        </div>

        <!-- MAP 
            <section>
                <h2>Office location</h2>
                <div class="map-flex">
                    <div>
                        <div class="map-container">
                            <div id="map"><img src="https://www.tremplin-numerique.org/wp-content/uploads/2021/03/1615212209_265_Comment-changer-lechelle-de-Google-Maps-de-miles-en-kilometres.png" alt="ciao"></div>
                        </div>
                    </div>
                    <div>
                        <div class="map-info">
                            <p>{{ profileData.address }}</p>
                            <p>{{ profileData.phone }}</p>
                            <p>{{ profileData.email }}</p>
                        </div>
                    </div>
                </div>
            </section>
            -->

        <!-- SECTION BOX MESSAGE -->
        <section class="message-box">
            <h2>Book an appointment for free</h2>
            <form>
                <label>Name:
                <input id="name" name="name" type="text" />
                </label> 
                
                <label >Email:
                <input id="email" name="email" type="text" />
                </label> 
                
                <label>Phone:
                <input id="name" name="phone" type="text" />
                </label> 
                
                <label>Message:
                <textarea id="name" name="name"></textarea>
                </label> 

                <input class="btn" type="submit" value="Send message">
            </form>
        </section>
    </div>
</v-main>
</template>

<script>
export default {
  name: "Home",
  data(){
    return {
        profileData: {
            name: "Luigi Bardella Gerbi",
            professions: ["Tuttologo", "Programmatore", "Marketer"],
            address: "Corso Savona 160, Asti, 14100",
            pic: "https://images.unsplash.com/photo-1536104968055-4d61aa56f46a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam purus quis lectus iaculis, vitae vestibulum orci dictum. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. ",
            vote: 4.5,
            phone: "3412345678",
            email: "twotimesgi@gmail.com"
        },
        profileReviews: [
            {
                name: "Marco",
                vote: 1,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/12/2019"
            },
            {
                name: "Antonio",
                vote: 2.4,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "20/1/2020"
            },
            {
                name: "Sara",
                vote: 5,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/6/2021"
            },
            {
                name: "Lorena",
                vote: 3.3,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "23/3/2019"
            },
                        {
                name: "Marco",
                vote: 1,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/12/2019"
            },
            {
                name: "Antonio",
                vote: 2.4,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "20/1/2020"
            },
            {
                name: "Sara",
                vote: 5,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/6/2021"
            },
            {
                name: "Lorena",
                vote: 3.3,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "23/3/2019"
            },
            {
                name: "Marco",
                vote: 1,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/12/2019"
            },
            {
                name: "Antonio",
                vote: 2.4,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "20/1/2020"
            },
            {
                name: "Sara",
                vote: 5,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "12/6/2021"
            },
            {
                name: "Lorena",
                vote: 3.3,
                message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                date: "23/3/2019"
            }
        ],
        reviewsShowed: 5,
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Anek+Latin:wght@200;300;500&display=swap');
    .inner{
        width: 90%;
        margin: 0 auto;
        display: flex;
        gap: 70px;
        color: #00234B;
        font-family: 'Anek Latin', sans-serif;
    }

    .profile-data{
        width: 60%;
        flex-basis: 60%;
    }

    section{
        padding: 0 0 30px 0;
    }

    .message-box{
        width: 40%;
        background-color: #F7F8F9;
        border:  1px solid #E1E1E4;
        padding: 20px;
        align-self: flex-start;
    }

    .message-box form{
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .badge{
        border-radius: 1rem;
        padding: 5px 20px;
        background-color: #F7F8F9;
    }

    .badge-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .prof-flex{
        display: flex;
        
    }

    .profile-image{
        width: 150px;
        height: 150px;
        border-radius: 200px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .card {
 width: 190px;
 height: 254px;
 background: rgb(255, 255, 255);
 border-radius: 0.4em;
 transition: border 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
 border: #E1E1E4 0.2em solid;
}

.card:hover {
 border: #00234B 0.2em solid;
}
    .data-flex{
        display: flex;
        align-items: center;
    }

    .profile-info{
        margin-left: 30px;
    }

    .profile-name{
        font-size: 40px;
        font-weight: bold;
    }

    .profile-image img{
        width: 100%;
        height: 100%;
    }

    .profile-address{
        font-size: 18px;
        color: #a1a1a1;
    }

    h2{
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    h3{
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    h4{
        font-size: 1.5rem;
    }

    input[type="text"], textarea{
        width: 100%;
        border:  1px solid #E1E1E4;
        background-color: white;
        margin-top: 5px;
    }

    .message-box textarea{ 
        height: 100px;
        resize: none;
    }

    .btn{
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 1.3rem;
        color:#00234B;
        background-color: #FDE721 ;
    }

    .btn.outlined{
        background-color: transparent;
        border: 2px solid #00234B;
    }
    
    .btn:hover{
        color: white;
        background-color:#00234B;
    }

    .btn.outlined:hover{
        border: 2px solid #00234B;
    }

    .ul-info{
        padding: 0;
        list-style: none;
        display: flex;
        gap: 25px;
        margin-top: 25px;
        border-top: #E1E1E4 solid 1px;
        border-bottom: #E1E1E4 solid 1px;
        height: 70px;
        line-height: 70px;
    }

    .ul-info li{
        height: 100%;
        border-bottom: 3px solid transparent;
        vertical-align: middle;
    }

    .ul-info > li > a{
        font-size: 1.3rem;
        font-weight: 400;
        color: #00234B;
    }

    .ul-info li:hover{
        border-bottom: 3px solid #00234B;
    }

    .map-flex{
        display: flex;
        gap: 25px;
    }
    
    .reviews-top-container{
        display: flex;
        width: 100%;
    }

    .reviews-top-container div{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 50%;
        padding: 0 30px;
    }

    .reviews-top-container div:first-child{
        border-right: 1px solid #E1E1E4;
    }

    .vote{
        font-size: 5rem;
        margin-top: -30px;
    }

    .banner{
        width: 100%;
        padding: 10px 20px;
        background-color: #F3F3F4;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .banner p{
        margin: 0;
    }

    .icon-container{
    padding: 15px 15px;
    display: flex;    
    }

    .icon{
        color: #00234B;
        justify-content: center;
        align-items: center;
    }

    .reviews-bottom-container{
        border-top: 1px solid #E1E1E4;
        display: flex;
        flex-direction: column;
        gap: 35px;
        padding-top: 20px;
    }

    .review{
        width: 100%;
    }

    .review > p{
        margin-bottom: 5px;
    }

    .reviews-info{
        font-size: .9rem;
        color: #a1a1a1;
    }

    .star ul li{
        display: inline-block;

    }

    .star ul {
        padding: 0;
        margin-bottom: 5px;
    }

    .star-color{
        color: #FF6372;
    }

    @media screen and (max-width: 950px){
        .inner{
            width: 100%;
            flex-direction: column;
            padding: 30px;
        }

        .message-box{
            width: 100%;
        }

        .profile-data{
            width: 100%;
        }

        .prof-flex{
            flex-direction: column;
            align-content: center;
        }

        .profile-image{
            margin-bottom: 20px;
            align-self: center;
        }

        .ul-info{
            overflow-x: scroll;
            overflow-y: hidden;
        }

        .data-flex{
            flex-direction: column;
            text-align: center;
            align-content: center;
        }

        .profile-info{
            margin-left: 0px;
        } 

        .btn{
            font-size: 1.3rem;
        }
    }
</style>