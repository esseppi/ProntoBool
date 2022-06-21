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
                        <li><a href="#">Insurance</a></li>
                        <li><a href="#">Location</a></li>
                        <li><a href="#">Reviews</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
            </section>

            <!-- ABOUT  -->
            <section class="about">
                <h2>About {{ profileData.name }}</h2>
                <p>{{ profileData.description }}</p>
            </section>

            <!-- MAP -->

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

            <!-- CURRICULUM -->
            <section class="curriculum">
                <div class=""></div>
                <h4>Curriculum Vitae</h4>
            </section>

            <!-- REVIEWS -->
            <!-- <div>
                <div>
                    <span>Overall rating</span>
                    <div>5</div>
                    <div>
                        <ul>
                            <li><v-icon>mdi-star</v-icon></li>
                            <li><v-icon>mdi-star</v-icon></li>
                            <li><v-icon>mdi-star</v-icon></li>
                            <li><v-icon>mdi-star</v-icon></li>
                            <li><v-icon>mdi-star</v-icon></li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="message-box">
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

                <input type="submit" value="Send message">
            </form>
        </div>
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
        }
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
        padding: 40px 0 40px 0;
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
        padding: 30px 0;
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
        margin: 15px 0;
        background-color: #F7F8F9;
    }

    .badge-container {
        display: flex;
        gap: 10px;
    }

    .prof-flex{
        display: flex;
    }

    .profile-image{
        width: 150px;
        height: 150px;
        border-radius: 200px;
        overflow: hidden;
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
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
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

    input[type="submit"], button{
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 1.3rem;
        color:#00234B;
        background-color: #FDE721 ;
    }

    input[type="submit"]:hover, button:hover{
        color: white;
        background-color:#00234B;
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
    
 
</style>