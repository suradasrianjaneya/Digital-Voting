/* ----- NAVIGATION BAR FUNCTION ----- */
    function myMenuFunction(){
      var menuBtn = document.getElementById("myNavMenu");

      if(menuBtn.className === "nav-menu"){
        menuBtn.className += " responsive";
      } else {
        menuBtn.className = "nav-menu";
      }
    }

/* ----- ADD SHADOW ON NAVIGATION BAR WHILE SCROLLING ----- */
    window.onscroll = function() {headerShadow()};

    function headerShadow() {
      const navHeader =document.getElementById("header");

      if (document.body.scrollTop > 50 || document.documentElement.scrollTop >  50) {

        navHeader.style.boxShadow = "0 1px 6px rgba(0, 0, 0, 0.1)";
        navHeader.style.height = "70px";
        navHeader.style.lineHeight = "70px";

      } else {

        navHeader.style.boxShadow = "none";
        navHeader.style.height = "90px";
        navHeader.style.lineHeight = "90px";

      }
    }


/* ----- TYPING EFFECT ----- */
   var typingEffect = new Typed(".typedText",{
      strings : ["voice","Power","Weapon"],
      loop : true,
      typeSpeed : 100, 
      backSpeed : 80,
      backDelay : 2000
   })


/* ----- ## -- SCROLL REVEAL ANIMATION -- ## ----- */
   const sr = ScrollReveal({
          origin: 'top',
          distance: '80px',
          duration: 2000,
          reset: true     
   })

  /* -- HOME -- */
  sr.reveal('.featured-text-card',{})
  sr.reveal('.featured-name',{delay: 100})
  sr.reveal('.featured-text-info',{delay: 200})
  sr.reveal('.featured-text-btn',{delay: 200})
  sr.reveal('.social_icons',{delay: 200})
  sr.reveal('.featured-image',{delay: 300})
  

  /* -- PROJECT BOX -- */
  sr.reveal('.project-box',{interval: 200})

  /* -- HEADINGS -- */
  sr.reveal('.top-header',{})

/* ----- ## -- SCROLL REVEAL LEFT_RIGHT ANIMATION -- ## ----- */

  /* -- ABOUT INFO & CONTACT INFO -- */
  const srLeft = ScrollReveal({
    origin: 'left',
    distance: '80px',
    duration: 2000,
    reset: true
  })
  
  srLeft.reveal('.about-info',{delay: 100})
  srLeft.reveal('.contact-info',{delay: 100})

  /* -- ABOUT SKILLS & FORM BOX -- */
  const srRight = ScrollReveal({
    origin: 'right',
    distance: '80px',
    duration: 2000,
    reset: true
  })
  
  srRight.reveal('.skills-box',{delay: 100})
  srRight.reveal('.form-control',{delay: 100})
  


/* ----- CHANGE ACTIVE LINK ----- */
  
  const sections = document.querySelectorAll('section[id]')

  function scrollActive() {
    const scrollY = window.scrollY;

    sections.forEach(current =>{
      const sectionHeight = current.offsetHeight,
          sectionTop = current.offsetTop - 50,
        sectionId = current.getAttribute('id')

      if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) { 

          document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.add('active-link')

      }  else {

        document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.remove('active-link')

      }
    })
  }

  window.addEventListener('scroll', scrollActive)
/*-------functions-------*/
document.addEventListener('DOMContentLoaded', function () {
    fetchcl();
    fetchballot();
    getresults();
    fetchtitle();
});
/*-------Candidate List--------------*/
function fetchcl()
{
fetch('usercl.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#data-table2 tbody');
                    tableBody.innerHTML='';
                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.Name}</td>
                            <td>${row.BelongsTo}</td>
                          <td>${row.DoB}</td>
                            <td>${row.Occupation}</td>
                           <td>${row.CandidateId}</td>
                        `;
                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}
/*-------Ballot Page--------------*/
function fetchballot() {
  // Example JavaScript code to conditionally display sections
  const messageSection = document.getElementById("message-section");
  const tableSection = document.getElementById("table-section");
  
  fetch('results1.php')
    .then(response => response.json())
    .then(data => {
       if (data !== null) {
                    var status = data;
                    // Now you can use the 'status' variable in your JavaScript code
                } else {
                    console.log('No data received from PHP.');
                }
      let showTable =false; // Initialize showTable inside the .then() block
      if (status=== 1) {
        showTable = true;
      }

      if (showTable) {
        // Display the table section
        tableSection.style.display = "block";
        messageSection.style.display = "none"; // Hide the message section
      } else {
        // Display the message section
        messageSection.style.display = "block";
        tableSection.style.display = "none"; // Hide the table section
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
fetch('ballot.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#data-table1 tbody');
                    tableBody.innerHTML='';
                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.Name}</td>
                            <td>${row.BelongsTo}</td>
                          <td>${row.DoB}</td>
                            <td>${row.Occupation}</td>
                           <td>${row.CandidateId}</td>
                          <td>${row.Votes}</td>
                        `;
                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}
/*---------Result Day-------------*/
function getresults()
{ 
fetch('results.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#data');
                    tableBody.innerHTML='';
                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                           <td>${row.Date}</td>
                        `;
                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}
/*----------POPUP PROFILE-----------*/
// JavaScript for showing and populating the profile pop-up
const profileButton = document.querySelector('.nav-button');
const profilePopup = document.getElementById('profile-popup');
const closePopupButton = document.getElementById('close-popup');
const emailField = document.querySelector('#profile-popup h4:nth-child(2)');
const numberField = document.querySelector('#profile-popup h4:nth-child(3)');
const voterIdField = document.querySelector('#profile-popup h4:nth-child(4)');
let userData; // Declare userData here

profileButton.addEventListener('click', () => {
    // Make an AJAX request to fetch user data from the server
    fetch('getprofile.php') // Replace with your server endpoint
        .then(response => response.json())
        .then(data => {
            userData = data; // Store the data in the userData variable
            voterIdField.textContent = `Voter Id: ${data[0].VoterId}`;
            emailField.textContent = `Email: ${data[0].Email}`;
            numberField.textContent = `Number: ${data[0].Number}`;
        })
        .catch(error => console.error('Error fetching user data:', error));

    profilePopup.style.display = 'block';
});

closePopupButton.addEventListener('click', () => {
    profilePopup.style.display = 'none';
});
window.history.pushState(null, null, window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, null, window.location.href);
};
/*-------Candidate List Title--------------*/
function fetchtitle()
{
fetch('usercltitle.php')
                .then(response => response.json())
                .then(data=> {
                    const titlera = document.querySelector('#title');
                     titlera.innerHTML=data.Title;
                      const titlera1 = document.querySelector('#title1');
                     titlera1.innerHTML=data.Title;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}