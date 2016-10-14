var input = document.getElementById("searchBox"),
    ul = document.getElementById("searchResults"),
    inputTerms, termsArray, prefix, terms, results, sortedResults;

var ajax = function(){
  if(input.value.length > 2){
    inputTerms = input.value.toLowerCase();
    results = [];
    termsArray = inputTerms.split(' ');
    prefix = termsArray.length === 1 ? '' : termsArray.slice(0, -1).join(' ') + ' ';
    terms = termsArray[termsArray.length -1].toLowerCase();
    xhr = new XMLHttpRequest() ;
    xhr.open("GET", "http://localhost/cakephpSearch.php?param=" + input.value, false) ;
    xhr.send();
    results.push(xhr.responseText);
    evaluateResults();
 }
 else clearResults();
}

var evaluateResults = function() {
  if (results.length > 0 && inputTerms.length > 0 && terms.length !== 0) {
    sortedResults = results.sort(sortResults);
    appendResults();
  } 
  else if (inputTerms.length > 0 && terms.length !== 0) {
    ul.innerHTML = '<li>Pas de résultat.</li>' ;
    
  }
  else if (inputTerms.length !== 0 && terms.length === 0) {
    return;
  }
  else {
    clearResults();
  }
};

var sortResults = function (a,b) {
  if (a.indexOf(terms) < b.indexOf(terms)) return -1;
  if (a.indexOf(terms) > b.indexOf(terms)) return 1;
  return 0;
}

var appendResults = function () {
  clearResults();
  
  for (var i=0; i < sortedResults.length && i < 5; i++) {
    var li = document.createElement("li"),
        result = prefix 
          + sortedResults[i].toLowerCase().replace(terms, '<strong>' 
          + terms 
          +'</strong>');
    
    li.innerHTML = result;
    ul.appendChild(li);
  }
  
  if ( ul.className !== "term-list") {
    ul.className = "term-list";
  }
};

var clearResults = function() {
  ul.className = "term-list hidden";
  ul.innerHTML = '';
};
  
input.addEventListener("keyup", ajax, false);