<template>
  <v-main>
    <div class="inner">
      <div class="reviews-top-container">
        <div class="">
          <h4>Views</h4>
          <div class="vote">{{ views }}</div>
        </div>
        <div class="">
            <h4>Messages</h4>
          <div class="vote">{{ profileMessages.length }}</div>
        </div>
      </div>
      <div class="reviews-bottom-container">
        <div v-for="(item, index) in profileMessages.slice(0, messagesShowed)" :key="index" class="review">
          <span class="review-name">{{ item.name }}</span>
          <div class="reviews-info">
            <span>{{ item.phone }}</span>
            • <span>{{ item.email }}</span>
            • <span>{{ item.date }}</span>
          </div>
          <p>{{ item.message }}</p>
        </div>
        <button @click="messagesShowed += 5" v-if="messagesShowed <= profileMessages.length" class="btn outlined">
          See more
        </button>
      </div>
    </div>
  </v-main>
</template>

<script>
export default {
  name: "Messages",
  data() {
    return {
      views: 100,
      profileMessages: [
        {
          name: "Eileen Merrington",
          message:
            "dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat",
          email: "emerrington0@jigsy.com",
          date: "2/14/2020",
          phone: "891-675-8273",
        },
        {
          name: "Missie Grimsley",
          message:
            "suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis",
          email: "mgrimsley1@google.es",
          date: "4/11/2020",
          phone: "558-800-2032",
        },
        {
          name: "Tybie McCane",
          message:
            "ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum",
          email: "tmccane2@discovery.com",
          date: "11/23/2021",
          phone: "571-927-3666",
        },
        {
          name: "Foster Briant",
          message:
            "praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus",
          email: "fbriant3@howstuffworks.com",
          date: "6/6/2020",
          phone: "219-424-1155",
        },
        {
          name: "Huntley Laurence",
          message:
            "sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat",
          email: "hlaurence4@cnet.com",
          date: "8/3/2021",
          phone: "806-474-3719",
        },
        {
          name: "Adriane Braime",
          message:
            "amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh",
          email: "abraime5@mysql.com",
          date: "4/11/2020",
          phone: "180-446-2533",
        },
        {
          name: "Gabriell Curme",
          message:
            "porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at",
          email: "gcurme6@prnewswire.com",
          date: "1/10/2022",
          phone: "187-332-1815",
        },
        {
          name: "Renault Cisco",
          message:
            "donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt",
          email: "rcisco7@wp.com",
          date: "2/27/2022",
          phone: "818-907-4841",
        },
        {
          name: "Goran Sindell",
          message:
            "morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar",
          email: "gsindell8@cdbaby.com",
          date: "6/25/2021",
          phone: "290-900-7648",
        },
        {
          name: "Melessa Tothe",
          message:
            "duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus",
          email: "mtothe9@rakuten.co.jp",
          date: "7/9/2020",
          phone: "782-515-5760",
        },
        {
          name: "Fulton Saben",
          message:
            "nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit",
          email: "fsabena@slideshare.net",
          date: "4/24/2021",
          phone: "601-805-2352",
        },
        {
          name: "Archibaldo Tidder",
          message:
            "erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante",
          email: "atidderb@privacy.gov.au",
          date: "3/20/2020",
          phone: "408-228-5594",
        },
        {
          name: "Amanda Lambard",
          message:
            "proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices",
          email: "alambardc@unicef.org",
          date: "8/6/2020",
          phone: "233-111-2896",
        },
        {
          name: "June Harder",
          message:
            "consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae",
          email: "jharderd@cam.ac.uk",
          date: "4/4/2020",
          phone: "492-361-6150",
        },
        {
          name: "Carlin Scrowton",
          message:
            "ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium",
          email: "cscrowtone@pagesperso-orange.fr",
          date: "9/27/2020",
          phone: "655-617-7232",
        },
        {
          name: "Torey Bascomb",
          message:
            "tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor",
          email: "tbascombf@japanpost.jp",
          date: "7/14/2021",
          phone: "521-969-4520",
        },
        {
          name: "Sileas Schollar",
          message:
            "quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor",
          email: "sschollarg@usa.gov",
          date: "1/20/2021",
          phone: "815-387-0191",
        },
        {
          name: "Frederica Staveley",
          message:
            "orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue",
          email: "fstaveleyh@ft.com",
          date: "4/22/2022",
          phone: "362-993-9695",
        },
        {
          name: "Morna Cavalier",
          message:
            "aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique",
          email: "mcavalieri@mapy.cz",
          date: "4/23/2020",
          phone: "648-596-7018",
        },
        {
          name: "Thibaud Ramsay",
          message:
            "magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus",
          email: "tramsayj@multiply.com",
          date: "4/28/2020",
          phone: "793-667-3117",
        },
      ],
      messagesShowed: 5,
      vote: null,
    };
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anek+Latin:wght@200;300;500&display=swap");
.inner {
  width: 90%;
  max-width: 1300px;
  margin: 0 auto;
  padding: 40px 0 40px 0;
  display: flex;
  flex-direction: column;
  gap: 70px;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
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
  color: #00234B;
}

.reviews-info{
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

.review-name{
  font-weight: bold;
  font-size: 1.3rem;
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
  background: #fafafa;
  padding: 30px;
  border: 1px solid #e1e1e4;
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

@media screen and (max-width: 600px){

	.vote{
		margin-top: -10px;
		font-size: 3.5rem;
	}

	h4{
		text-align: center;
		font-size: 1rem;
	}

}
</style>
