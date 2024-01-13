
  class FeatureCard extends HTMLElement {
    constructor() {
      super();

      // Create a shadow DOM
      this.attachShadow({ mode: 'open' });
      // Get the content attribute value or set a default value


      // Create a paragraph element
      //const paragraph = document.createElement('p');

      // Set the text content of the paragraph
      //paragraph.textContent = content;

      // Append the paragraph to the shadow DOM
      //this.shadowRoot.appendChild(paragraph);
    }
    connectedCallback(){
        if(this.hasAttribute('content')){
           
        }
        const img = this.getAttribute('img') ;
        const title = this.getAttribute('title') ;
        const description = this.getAttribute('description') ;
        const link = this.getAttribute('link') ;
        this.shadowRoot.innerHTML=`
        <link rel="stylesheet" href="./feature_card.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

       <div class='feature_card'>
       <img src="${img}" class="feature_card_img">
       <div class="feature_card_info">
           <p class="feature_card_info_title">${title}</p>
           <p class="feature_card_info_description">${description}</p>
       </div>
   </div>

       

        `;
    }
  }

  // Define the custom element
  customElements.define('feature-card', FeatureCard);
