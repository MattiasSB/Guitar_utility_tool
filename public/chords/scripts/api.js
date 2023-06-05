

//chord extension starts as an empty string
let chordExtension = '';
//list of paths to reference
const button = document.querySelector('#api_search');
const container = document.querySelector(".results");
const spinContainer = document.querySelector('.container');

//shows the status of the menu results
resultPopulation = false;

//calls the functions when button is clicked
button.addEventListener('click', () => {
    //retrieves the input value for searching
    chordExtension = document.querySelector('input').value;
    //makes sure it isn't empty
    if(chordExtension !== ''){
     //searches Api
    searchApi();}
    
})

document.addEventListener('keyup', e => {

    chordExtension = document.querySelector('input').value;
    if(e.key == "Enter" && chordExtension !== ''){
        searchApi();
    }
})

//APi search function
function searchApi() {
    //makes the spinner visible while loading results
spinner();

//concatenates the user inputted search extension to the uri
const uri = 'https://api.uberchord.com/v1/chords?nameLike='  + chordExtension;

//fetches full uri
fetch(uri)

//first retrieves the response in json format
.then   (
            response => response.json()
        )
        .then((data) => {
            //uses fetched data as callback in function
            drawDiagram(data);
        })
        .catch((error) => {
            //thows an error if something hecked up
            console.error('Error', error);
        })
}
//called on initial fetch request
function drawDiagram(response){
    //closes spinner as results are now loaded
    spinContainer.style.visibility = 'hidden';

    //checks to see if list has entries
    if(resultPopulation == true) {
        //if list has a first result it will remove until list is empty
        while (container.firstChild){
            //removes the child populated in the container
            container.removeChild(container.firstChild);
        }
        //shows list is now empty
        resultPopulation = false;
    }


    //for each result retrieved execute the following
    for(i = 0; i < response.length; i++){
        let currentResponse = response[i].chordName;

        currentResponse = currentResponse.replace(/,/g, '');
        //create a new paragraph
        const newP = document.createElement('p');
        //fill the textfield with retrieved api data
        const textField = document.createTextNode(currentResponse);
        //append the text to paragraph that was created
        newP.appendChild(textField);
        //references the existing heading
        const resultsHeading = document.querySelector('.results_container h3');
        //shows number of retrieved results
        resultsHeading.innerHTML = 'Results (' + (i + 1) + '):';
        //appends results to container
        container.appendChild(newP);
        //checks to see if results have populated
        if(i > 0 && resultPopulation == false){
            //changes result population status to true
            resultPopulation = true;
        }
    }

    //selects all of the p's created within results
    const resultsP = document.querySelectorAll('.results p');
    //executes the following for each result in the the list
    resultsP.forEach(item => {
        //adds a click event listener to each result
        item.addEventListener('click', ()=>{
            //calls the spinner while loading
            spinner(); 
            //fetches the first result of the specific chord that is requested
            fetch('https://api.uberchord.com/v1/chords?nameLike=' + item.innerHTML)
            //retrieves response as json format
            .then(
                response => response.json()
            )
            //calls the next function to display the data within frame
            .then((data) => {
                affectFrame(data);
            })
            //catches any errors if I made an oopsie
            .catch((error) => {
            console.error('Error', error);
             })
        })
    })

    //the function executes upon API click event request is made
    function affectFrame(response){
        //closes spinner
        spinContainer.style.visibility = 'hidden';
        //references chord finger positions that are currently displayed
        const currDots = document.querySelectorAll('.chordFingerPosition');
        //removes opacity of currently placed positions
        currDots.forEach(item => {
            item.style.opacity = '0';
        })
        //references the heading within the frame
        const scaleHeading = document.querySelector('#name');
        //references the frett number of the nutt
        const frettNumberLowHeading = document.querySelector('.frettNum');
        //stores the response of the API finger position
        const frettNumCleaner = response[0].strings;

        //splits the array into an array of substrings just representing the retrieved data no longer in array format
        //strings used to return e.g. (X 0 2 2 0 1)
        //will now return as '(', 'X', '0'...
        const values = frettNumCleaner.split(' ');
        //creates an empty array
        const stringArray = [];
        
        //for each and every value in the split up substrings
        for (let i = 0; i < values.length; i++) {
            //return every value under value constant
        const value = values[i];
        //if a value returned is a letter push the value as a string to the empty array
        if (value === 'X') {
            stringArray.push(value);
        }
        //otherwise the value is to be pushed as an integer
        else {
            stringArray.push(parseInt(value));
        }
        }
        
        //string array formatting e.g. [1, 2, 'X', 0, 1, 0]

        //two empty values to be used to represent the highest and lowest string number
        var lowestNumber = null;
        var highestNumber = null;
        
        //for each and every item in the array execute the following code once
        for (var i = 0; i < stringArray.length; i++) {
            //stores the items of the array as number variable
          var number = stringArray[i];
          //if the string is a number and is not 0 execute the following
          if (typeof number === 'number' && number !== 0 && !isNaN(number)) {
            //if the lowest number isn't null or the number isnt higher then others
            if (lowestNumber === null || number < lowestNumber) {
                //set the lowest number to all that match this description
              lowestNumber = number;
            }
            //if the number is not not null or  number lower then the highest number then do the following
            if (highestNumber === null || number > highestNumber) {
                //set the highest number variable to all that matches description
              highestNumber = number;
            }
          }
        }

        //frett number heading to represent the edge of diagram frett #
            frettNumberLowHeading.innerHTML = lowestNumber - 1;
            //scaleHeading text is made to be the response chordname of selected
            let currentResponse = response[0].chordName;

            currentResponse = currentResponse.replace(/,/g, '');

            scaleHeading.innerHTML = currentResponse
            //executes all the string functions
            lowEDetect();
            ADetect();
            DDetect();
            GDetect();
            BDetect();
            highEDetect();
            
        
        //detects the position of the string and maps grid
        function lowEDetect(){
            //sets an empty variable
            let dotNumE = null;
            //creates a variable to store the first result of the array eg, 0
            var cfp = stringArray[0];
            //selects the class of the low e dot
            const lowEStringValue = document.querySelector('.e_low');

            //changes the value of the heading beside low e string to the cfp return string #
            lowEStringValue.innerHTML = stringArray[0];
            
            //checks that the value is equal to the lowest # and that it isn't higher then 5
            //also checks to see if the value is greater then 3 and that the highest number in the array isn't equal to 5
            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                // if the above conditions are true subtract the lowest amount on the strings and add 1
                cfp = cfp - lowestNumber + 1; 
                //run the function that changes variable extensions
                checkNum();
            }
            //of none of the above if was true
            else {
                //run the function that changes variable extensions
                checkNum()
            }
            //changes the extension based on the string #
            function checkNum(){
                //all numbers of dotNumE correspond to the # on the extension of the classname for that dot position
                if(cfp == 0 || cfp == 'X'){
                    dotNumE = null;
                }
                else if(cfp == 1){
                    dotNumE = 25;
                    
                }
                else if(cfp == 2){
                    dotNumE = 26;
                    
                }
                else if(cfp == 3){
                    dotNumE = 27;
                    
                }
                else if(cfp == 4){
                    dotNumE = 28;
                    
                }
                else if(cfp == 5){
                    dotNumE = 29;   
                }
                //execute the function that changes the dot position
                visDot()
                function visDot(){
                    if(dotNumE !== null){
                        //selects the dot based on the value 1-5
                        let lowEDot = document.querySelector('.cfp-' + dotNumE);
                        //toggles visibility for current position
                        lowEDot.style.opacity = '100';
                    }
                }
            }   
        }
        //same process for the A string
        function ADetect(){
            let dotNumA = null;
            var cfp = stringArray[1];
            
            const AStringValue = document.querySelector('.a');

            AStringValue.innerHTML = stringArray[1];

            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                cfp = cfp - lowestNumber + 1; 
                checkNum();
            }
            else {
                checkNum()
            }

            function checkNum(){
                if(cfp == 0 || cfp == 'X'){
                    dotNumA = null;
                }
                else if(cfp == 1){
                    dotNumA = 20;
                    
                }
                else if(cfp == 2){
                    dotNumA = 21;
                    
                }
                else if(cfp == 3){
                    dotNumA = 22;
                    
                }
                else if(cfp == 4){
                    dotNumA = 23;
                    
                }
                else if(cfp == 5){
                    dotNumA = 24;   
                }
                visDot()
                function visDot(){
                    if(dotNumA !== null){
                        let ADot = document.querySelector('.cfp-' + dotNumA);
                        ADot.style.opacity = '100';
                    }
                }
            }   
            
        }
        //process repeats for th D string
        function DDetect(){
            let dotNumD = null;
            var cfp = stringArray[2];
            
            const DStringValue = document.querySelector('.d');

            DStringValue.innerHTML = stringArray[2];

            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                cfp = cfp - lowestNumber + 1; 
                checkNum();
            }
            else {
                checkNum()
            }

            function checkNum(){
                if(cfp == 0 || cfp == 'X'){
                    dotNumD = null;
                }
                else if(cfp == 1){
                    dotNumD = 15;
                    
                }
                else if(cfp == 2){
                    dotNumD = 16;
                    
                }
                else if(cfp == 3){
                    dotNumD = 17;
                    
                }
                else if(cfp == 4){
                    dotNumD = 18;
                    
                }
                else if(cfp == 5){
                    dotNumD = 19;   
                }
                visDot()
                function visDot(){
                    if(dotNumD !== null){
                        let DDot = document.querySelector('.cfp-' + dotNumD);
                        DDot.style.opacity = '100';
                    }
                }
            }   
            
        }
         //process repeats for th G string
        function GDetect(){
            let dotNumG = null;
            var cfp = stringArray[3];
            
            const gStringValue = document.querySelector('.g');

            gStringValue.innerHTML = stringArray[3];

            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                cfp = cfp - lowestNumber + 1; 
                checkNum();
            }
            else {
                checkNum()
            }

            function checkNum(){
                if(cfp == 0 || cfp == 'X'){
                    dotNumG = null;
                }
                else if(cfp == 1){
                    dotNumG = 10;
                    
                }
                else if(cfp == 2){
                    dotNumG = 11;
                    
                }
                else if(cfp == 3){
                    dotNumG = 12;
                    
                }
                else if(cfp == 4){
                    dotNumG = 13;
                    
                }
                else if(cfp == 5){
                    dotNumG = 14;   
                }
                visDot()
                function visDot(){
                    if(dotNumG !== null){
                        let GDot = document.querySelector('.cfp-' + dotNumG);
                        GDot.style.opacity = '100';
                    }
                }
            }    
        }
         //process repeats for th B string
        function BDetect(){
            let dotNumB = null;
            var cfp = stringArray[4];
            
            const bStringValue = document.querySelector('.b');

            bStringValue.innerHTML = stringArray[4];

            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                cfp = cfp - lowestNumber + 1; 
                checkNum();
            }
            else {
                checkNum()
            }

            function checkNum(){
                if(cfp == 0 || cfp == 'X'){
                    dotNumB = null;
                }
                else if(cfp == 1){
                    dotNumB = 5;
                    
                }
                else if(cfp == 2){
                    dotNumB = 6;
                    
                }
                else if(cfp == 3){
                    dotNumB = 7;
                    
                }
                else if(cfp == 4){
                    dotNumB = 8;
                    
                }
                else if(cfp == 5){
                    dotNumB = 9;   
                }
                visDot()
                function visDot(){
                    if(dotNumB !== null){
                        let BDot = document.querySelector('.cfp-' + dotNumB);
                        BDot.style.opacity = '100';
                    }
                }
            }    
        }
         //process repeats for th high E string
        function highEDetect(){
            let dotNumEh = null;
            var cfp = stringArray[5];
            
            const highEStringValue = document.querySelector('.e_high');

            highEStringValue.innerHTML = stringArray[5];

            if(cfp == lowestNumber && cfp > 3 && highestNumber > 5 || cfp > 3 && highestNumber > 5){
                cfp = cfp - lowestNumber + 1; 
                checkNum();
            }
            else {
                checkNum()
            }

            function checkNum(){
                if(cfp == 0 || cfp == 'X'){
                    dotNumEh = null;
                }
                else if(cfp == 1){
                    dotNumEh = 0;
                    
                }
                else if(cfp == 2){
                    dotNumEh = 1;
                    
                }
                else if(cfp == 3){
                    dotNumEh = 2;
                    
                }
                else if(cfp == 4){
                    dotNumEh = 3;
                    
                }
                else if(cfp == 5){
                    dotNumEh = 4;   
                }
                visDot()
                function visDot(){
                    if(dotNumEh !== null){
                        let highEDot = document.querySelector('.cfp-' + dotNumEh);
                        highEDot.style.opacity = '100';
                    }
                }
            }   
        }
    }
}

//turns on the spinner
function spinner(){
    //makes spinner visible
    spinContainer.style.visibility = 'visible';
}