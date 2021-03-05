
var select= document.querySelectorAll('.select');
const test = document.querySelector(".test");
const nextBtn= document.querySelector("#next-btn")
const submitBtn = document.querySelector("#submit-btn");
const sideBar = document.querySelector(".side-bar");
const tab= document.querySelector(".tab");
const progress_bar= document.querySelector("#progress-bar")
const totalScore= document.querySelector("#total-score");
const modal= document.querySelector(".modal");
const collective_action_btn=document.querySelector("#collective-action-btn");
var questionLeftOut = [...document.querySelectorAll(".question-leftout")];
var tabs_index=0;
var value=0;
var tabs=[]
var store=[];
var total={};
class storage{
    static store_questions(){
        localStorage.setItem("questions", JSON.stringify(store));
    }
    static get_questions(){
        localStorage.getItem()
    }
}
class Products {
    async getQuestions() {
        try {
            tabs= new Queue(2);
            var data = await fetch("js/test.json");
            let result = await data.json();
            let quiz= result.test
            quiz.forEach(part=>{
                tabs.enqueue(part)
            })
            progress_bar.max=tabs.get_total_items();
            return tabs;
        } catch (error) {
            console.log(error)
        }
    }
    
}
 
class UI {
    getOptions(marks){
        var option = "";
        marks.forEach(mark=>{
            option+=`<option value="${mark}">${mark} marks</option>`
        })
        return option
    }
    displayQuestions() {
        var result="";
        var questions =tabs.dequeue();
         var key=Object.keys(questions);
        tab.textContent= key[0];
        this.create_question_objects(questions[key[0]]);
        questions[key[0]].forEach(question => {
            result +=`<div class="question-box">
                   <input type="number" readonly value="${question.question_id}" class="question_id">
                   <div class="question">${question.question}</div>
                   <div class="marks">
                    <select class="selected" data-id="${question.question_id}">`
                   + this.getOptions(question.marks) +
                    `<option value="pending" selected>pending</option>
                    </select>
                    </div>
                    <div class="overlay">
                    <button class="remarkBtn">Remark</button>
                    </div>
                   </div>`;
        });
        test.innerHTML = result;
    }
    create_question_objects(tabs){
        tabs.forEach(tab=>{
            var question= new Question();
            question.set_question_id(tab.question_id);
            question.set_question(tab.question);
            question.set_marks(tab.marks);
            question.set_status(false)
            store[question.get_question_id()]=question;
        })
    }
     static getSelecetedValues() {
        var overlay = [...document.querySelectorAll(".overlay")];
        var select = [...document.querySelectorAll(".selected")];
        select.forEach((option,index)=> {
            option.addEventListener("change",(event)=>{
                if(event.target.value!=="pending"){
                     value++;
                var id = event.target.dataset.id;
                var score= event.target.value;
                store[id].set_status(true);
                store[id].mark_question(parseInt(score),total);
                totalScore.value=total.computeTotal();
                progress_bar.value= value;
                overlay[index].style.display="flex"
                }
            })
        })
    }
    validate(){
        var status=false;
        var length= this.get_empty_fields().length
        if(length < 1){
            status= true;
        }
        return status;
    }
    get_empty_fields(){
        var empty_fields=[];
        Object.values(store).forEach(question=>{
            if(question.get_status()==false){
               if(empty_fields.includes(question.get_question_id())){
                   return false;
               }
                else{
                    empty_fields.push(question.get_question_id())
                }
            }
        })
        if(empty_fields.includes(undefined)){
            empty_fields=empty_fields.filter(item=>{
                item==undefined
            })
        }
        return empty_fields;
    }
    display_empty_fields(){
        var result;
        this.get_empty_fields().forEach(id=>{
            result += `<button class="question-leftout">${id}</button>`
        });
        sideBar.innerHTML=result;
    }
    remark_question(){
        var remarkBtn= [...document.querySelectorAll(".remarkBtn")];
        var select=[...document.querySelectorAll(".selected")];
        var overlay= [...document.querySelectorAll(".overlay")]
        remarkBtn.forEach((button,index)=>{
            button.addEventListener("click",()=>{
                value--;
                overlay[index].style.display="none";
                select[index].value="pending";
                progress_bar.value=value;
                var id =select[index].dataset.id;
                store[id].set_status(false);
            })
        })
    }
    get_leftout_questions(){
        var leftout_question_btn=[...document.querySelectorAll(".question-leftout")];
        var select =[...document.querySelectorAll(".selected")];
        leftout_question_btn.forEach((button,index)=>{
            button.addEventListener("click",()=>{
//                button.removeChild(index)
            })
        })
    }

}

function showSideBar(){
      sideBar.classList.add("hide-side-bar");
       questionLeftOut.forEach((question,index)=>{
          if(question.style.animation){
              question.style.animation = "";
          }
           else{
                question.style.animation = `fade-question-leftout 4s ease forwards ${index / 5 + 0.2}s`;
           }
       })
}


document.addEventListener("DOMContentLoaded", ()=>{
	var products = new Products();
    const ui= new UI();
    total = new Total();
    products.getQuestions().then(tabs => {
        ui.displayQuestions();
        UI.getSelecetedValues();
        ui.remark_question();
        tabs.get_total_items();
        if(tabs.front===tabs.get_queue_length()){
            nextBtn.style.display="none"
            submitBtn.display="block"
            submitBtn.addEventListener("click",()=>{
                submitBtn.disabled=true;
                modal.style.display="flex";
            });
            collective_action_btn.addEventListener("click",()=>{
                window.location= DOMAIN+"public/correctiveaction.php";
            })
        }
        nextBtn.style.display="block";
    }).then(()=>{
        nextBtn.addEventListener("click",()=>{
            if(ui.validate()===true){
                if(tabs.front!==tabs.length){
                    submitBtn.style.display="none";
                    nextBtn.style.display="block";
                    ui.displayQuestions();
                    UI.getSelecetedValues();
                    ui.remark_question();
                }
                else{
                   nextBtn.style.display="none";
                    submitBtn.style.display="block";
                    submitBtn.addEventListener("click",()=>{
                        send_data();
                        submitBtn.disabled=true;
                        modal.style.display="flex";
                    });
                }
            }
            else{
                showSideBar();
                ui.display_empty_fields();
                ui.get_leftout_questions();
            }
        })
    })
});