let toggle_p = document.querySelector(".toggle-p");

        toggle_p.addEventListener("click", () => {
            let slide = document.querySelector(".nav-fixed");
            slide.classList.toggle("nav-fixed-active");
        });

        let wrap = document.createElement("div");
        wrap.classList.add("wrap-top-data");

        let button = document.createElement("button");
        button.classList.add("button_databale");
        button.innerHTML = `<img src="img/Vector.svg" alt="">`;
        
        wrap.innerHTML = `
            <div class="w-d-t-left">
            <form>
                <button class="ml-3 btn btn-datatable-2"><img class="img-btn-datatable" src="img/list_filter_icon_144244.svg" alt=""> Filters</button>
                <label id="remove-button" class="btn btn-datatable-2" for="att">
                <img class="img-btn-datatable" src="img/Vector 3.svg" alt="">  Attatchments
                <input id="att" type="file">
            </label>
            </form>
        </div>
        `;

        

const data = ["all", "completed", "panding", "returns", "cancelations"];
let dataval = document.querySelectorAll(".data-custom");


var btns = document.getElementsByClassName("btn-data");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active-data");
    current[0].className = current[0].className.replace(" active-data", "");
    this.className += " active-data";

    });
}






$(document).ready(function() {
    var table = $('#example').DataTable({
        responsive: true,
        columnDefs: [ {
            orderable: false,
            // className: 'select-checkbox',
            targets:   0,
            'checkboxes': {
                'selectRow': true
            }
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "info":     false,
        language: { search: '', searchPlaceholder: "Search Products, brands",
        oPaginate: {
            sNext: '<i class="fas fa-angle-right curser-icon"></i>',
            sPrevious: '<i class="fas fa-angle-left curser-icon"></i>'
        }},
    });
        $("#example_filter").append(wrap)
        $("#example_length").remove();
        $("#example_filter label input").addClass("input_datatable");
        $("#example_filter label").addClass("label_datatable");
        $("#example_filter label").append(button);
        $("#remove-button").removeClass("label_datatable");
        $(".r-sort").removeClass("sorting");
        $("#remove-button button").remove();

    } );