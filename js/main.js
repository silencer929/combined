 var DOMAIN= "http://localhost:8080/cert/"
 var response
class Corrective_Action {
   async submit(comment){
       var result2=` <div class="row">
	            <div class="comment-action-column" style="width:80%; min-height: 100px;">
	                <div class="" style=" min-height: 50px;"> <legend>action</legend>${comment.action}</div>
	                <div class=""style="min-height:50px;"><legend>comment</legend>
                                ${comment.comment}
	                </div>
	            </div>
	            <div class="buttons-column" style="width:20%; min-height:100px;display:flex; flex-direction: column";>
	            <button class="edit-btn2">edit</button>
	            <button class="delete-btn2">delete</button>
	            </div>
	        </div>`;
           var result = `<tr class="1">
	                    <td>1</td>
	                    <td>${comment.action}</td>
	                    <td>${comment.comment}</td>
	                    <td><button class="edit-btn">edit</button>
	                    <td><button class="delete-btn">detele</button></td>
	                    </td>
	                </tr>`;
        $("#myTable").append(result);
       $(".table2").append(result2);
}
    edit_action() {
        var comment_text_box = document.querySelector('[name="comment"]');
        var action_text_box = document.querySelector('[name="action"]');
        var edit_buttons = [...document.querySelectorAll("#myTable tbody .edit-btn")];
        var tbody_rows = [...document.querySelectorAll("#myTable tbody tr")];
        var edit_buttons2=[...document.querySelectorAll(".table2 .edit-btn2")]
        edit_buttons.forEach((btn, index) => {
            btn.addEventListener("click", () => {
                var td1 = [...tbody_rows[index].children];
                comment_text_box.value = td1[1].textContent;
                action_text_box.value = td1[2].textContent;
            })
        })
        edit_buttons2.forEach((btn,index)=>{
            btn.addEventListener('click',()=>{
                console.log(btn)
            })
        })

    }
    delete_action() {
        var table_tbody = document.querySelector("#myTable tbody");
        var table2= document.querySelectorAll(".table2");
        var table2_rows=document.querySelectorAll(".table2 .row")
        var delete_buttons = [...document.querySelectorAll("#myTable tbody .delete-btn")];
        var tbody_rows = [...document.querySelectorAll("#myTable tbody tr")];
        var delete_buttons=[...document.querySelectorAll(".delete-btn")]
        var delete_buttons2=[...document.querySelectorAll(".delete-btn2")]
        delete_buttons.forEach((btn, index) => {

            if (tbody_rows[index]) {
                btn.addEventListener("click", () => {
                    table_tbody.removeChild(tbody_rows[index]);
                    console.log(btn)
                })
            }

        });
            delete_buttons2.forEach((btn,index)=>{
            btn.addEventListener('click',()=>{
                table2.removeChild([table2_rows[index]])
            })
        })
    }
    }
