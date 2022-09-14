function createCard(html) {
   const template = document.createElement("template");
   template.innerHTML = html.trim();

   return template.content.firstElementChild;
}
function showPlayer() {
   document.querySelector(".player").innerHTML += playerEmbebed;
}
fetch(
   //"https://www.googleapis.com/youtube/v3/search?key=AIzaSyDlNBNqNvptNiuDBQS1-fEtCB-91ShmyoU&part=snippet&channelId=UC3nyYrMXzRSyr8K8mR5nUiA&type=video"
   "https://www.googleapis.com/youtube/v3/search?key=AIzaSyCx1_-nW1xTdwDCXmUnV26NTtlYbBubkaw&part=snippet&channelId=UCKtE8yeLq5jkZSbkJt3nFuA&type=video&maxResults=50&q=webinar"
)
   .then((result) => {
      return result.json();
   })
   .then((data) => {
      let videos = data.items;
      console.log(videos);

      for (video of videos) {
         let videoId = video.id.videoId;
         let videoUrl = `https://www.youtube.com/watch?v=${videoId}`;
         let videoThumbnail = video.snippet.thumbnails.high.url;
         let titulo = video.snippet.title;
         let doctors = titulo.split(" - ");
         let title = doctors[0];
         let doctorName = doctors[1];
         let description = video.snippet.description;
         let playerEmbebed = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoId}?controls=0" title="${title}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
         `;

         document.querySelector(".webinars-item-title").innerText = title;
         document.querySelector(".webinars-item-subtitle").innerText =
            doctorName;

         //console.log(videoUrl);

         const card = createCard(`
<div class="webinars-item grid-item">
       <div class="player"></div>
       <div class="overlay-color"></div>
                  <picture>
                     <img
                        src="${videoThumbnail}"
                        alt="${description}"
                     />
                  </picture>
                  <a href="" class="tags tags-enfermeria">ENFERMERÍA</a>
                  <div class="webinars-item-body">
                     <h5 class="webinars-item-title mt-2">
                     ${title}
                     </h5>
                     <h6 class="webinars-item-subtitle mt-2">
                        ${doctorName}
                     </h6>
                  </div>
                  <div class="webinars-item-footer">
                     <div class="left">
                        <button class="btn naked">
                           <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="22"
                              height="21"
                              viewBox="0 0 22 21"
                              fill="none"
                           >
                              <path
                                 d="M4.4628 20.2157L4.46379 20.2154L4.4628 20.2157ZM4.4628 20.2157L4.45935 20.2169L4.4628 20.2157ZM13.3075 7.93453L13.4217 8.27583H13.7816H21.2077L15.2091 12.5148L14.9055 12.7294L15.0235 13.0819L17.3253 19.9587L11.2886 15.6928L11.0001 15.489L10.7115 15.6928L4.66923 19.961L6.97177 13.0819L7.08976 12.7294L6.78618 12.5148L0.787583 8.27583H8.20883H8.56874L8.68297 7.93453L10.9952 1.02635L13.3075 7.93453Z"
                                 stroke="#FF266E"
                              />
                           </svg>
                        </button>
                        <button class="btn naked">
                           <svg
                              version="1.2"
                              baseProfile="tiny"
                              id="Capa_1"
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              x="0px"
                              y="0px"
                              viewBox="0 0 22 19"
                              overflow="visible"
                              xml:space="preserve"
                           >
                              <path
                                 fill="none"
                                 stroke="#FF266E"
                                 stroke-miterlimit="10"
                                 d="M17.1,0.8c-2.2-0.6-4.4,0.6-6.1,2.4c-1.8-2-3.9-3-6.2-2.4
	c-2,0.6-4,2.3-3.9,4.9c0.1,7.1,9.9,12.7,10,12.8c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0.1,0,10-5.6,10-12.7C21.1,3.2,19.1,1.3,17.1,0.8z
	"
                              />
                           </svg>
                        </button>
                        <button class="btn naked">
                           <svg
                              version="1.2"
                              baseProfile="tiny"
                              id="Capa_1"
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              x="0px"
                              y="0px"
                              viewBox="0 0 20 20"
                              overflow="visible"
                              xml:space="preserve"
                           >
                              <g>
                                 <circle
                                    fill="none"
                                    stroke="#FF266E"
                                    stroke-miterlimit="10"
                                    cx="4.1"
                                    cy="10"
                                    r="3.5"
                                 />
                                 <circle
                                    fill="none"
                                    stroke="#FF266E"
                                    stroke-miterlimit="10"
                                    cx="16"
                                    cy="16.3"
                                    r="3.5"
                                 />
                                 <circle
                                    fill="none"
                                    stroke="#FF266E"
                                    stroke-miterlimit="10"
                                    cx="16"
                                    cy="3.7"
                                    r="3.5"
                                 />
                                 <path
                                    fill="none"
                                    stroke="#FF266E"
                                    stroke-miterlimit="10"
                                    d="M7.1,8.4l5.8-3L7.1,8.4z"
                                 />
                                 <line
                                    fill="none"
                                    stroke="#FF266E"
                                    stroke-miterlimit="10"
                                    x1="7.2"
                                    y1="11.6"
                                    x2="12.9"
                                    y2="14.7"
                                 />
                              </g>
                           </svg>
                        </button>
                     </div>
                     <button  onclick="showPlayer()" class="btn btn-primary btn-big right playYoutube"
                        ><i class="mdi mdi-play"></i
                     ></button>
                  </div>
               </div>
`);
         document.getElementById("webinarsGrid").appendChild(card);
      }
   });
