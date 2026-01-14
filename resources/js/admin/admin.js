import "./bootstrap";
import "laravel-datatables-vite";
import "select2";
import select2 from "select2";
import "select2/dist/css/select2.min.css";
select2();
import Chart from "chart.js/auto";
window.Chart = Chart;
import Swal from "sweetalert2";
import {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph,
    SourceEditing,
    HtmlEmbed,
    GeneralHtmlSupport,
} from "ckeditor5";

// Multi Select2 with tags support
// initialize select2
$("#colorSelect").select2({
    tags: true,
    placeholder: "Select or add tags",
    tokenSeparators: [",", " "],
    width: "100%",
});

// find Livewire component id
let livewireId = $("#blog-create-component")
    .closest("[wire\\:id]")
    .attr("wire:id");

// listen for change
$("#colorSelect").on("change", function () {
    let selectedTags = $(this).val();
    Livewire.find(livewireId).set("formData.tags", selectedTags);
});

if ($(".editor").length) {
    document.querySelectorAll(".editor").forEach((editorElement) => {
        ClassicEditor.create(editorElement, {
            licenseKey: "GPL",
            plugins: [
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph,
                SourceEditing,
                HtmlEmbed,
                GeneralHtmlSupport,
            ],
            toolbar: [
                "undo",
                "redo",
                "|",
                "bold",
                "italic",
                "|",
                "fontSize",
                "fontFamily",
                "fontColor",
                "fontBackgroundColor",
                "|",
                "sourceEditing",
                "|",
                "htmlEmbed",
            ],

            // Allow all HTML tags, attributes, classes, and inline styles
            htmlSupport: {
                allow: [
                    {
                        name: /.*/, // allow all elements
                        attributes: true,
                        classes: true,
                        styles: true,
                    },
                ],
            },

            htmlEmbed: {
                showPreviews: true,
            },
        })
            .then((newEditor) => {
                // Store instance
                window.editors = window.editors || [];
                window.editors.push(newEditor);

                newEditor.model.document.on("change:data", () => {
                    const data = newEditor.getData();
                    const textarea = editorElement
                        .closest("[wire\\:ignore]")
                        .querySelector("textarea");
                    if (textarea) {
                        textarea.value = data;
                        textarea.dispatchEvent(new Event("input")); // Tell Livewire value changed
                    }
                });
            })
            .catch((error) => console.error(error));
    });
}

// Password Icons js start ---
$(".password-toggle-group .toggle-password-btn").on("click", function () {
    const $group = $(this).closest(".password-toggle-group");
    const $input = $group.find("input");
    const $icon = $(this).find("i");

    if ($input.attr("type") === "password") {
        $input.attr("type", "text");
        $icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
    } else {
        $input.attr("type", "password");
        $icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
    }
});

// Menu js end ----
$(".hamburg-icon").click(function () {
    $(".sidebar-menus .accordion-item .show").removeClass("show");
    $(".sidebar").toggleClass("sidebar-close");
    $(".main-content").toggleClass("fullWidth-screen");
});

/** Bar chart Code Start */
$(function () {
    const orderCanvas = $("#orderMonthlyChart")[0];
    if (orderCanvas) {
        const ctx = orderCanvas.getContext("2d");
        const currentYearSales = window.currentYearSales.map((v) =>
            Number(v.toString().replace(/,/g, ""))
        );
        const previousYearSales = window.previousYearSales.map((v) =>
            Number(v.toString().replace(/,/g, ""))
        );
        const currentYearOrders = window.currentYearOrders.map((v) =>
            Number(v.toString().replace(/,/g, ""))
        );
        const previousYearOrders = window.previousYearOrders.map((v) =>
            Number(v.toString().replace(/,/g, ""))
        );
        displayChart(
            ctx,
            currentYearSales,
            previousYearSales,
            currentYearOrders,
            previousYearOrders,
            true
        );
    }
});

//Simple Bar chart Function Code Start
function displayChart(
    idToDisplay,
    currentYearSales,
    previousYearSales,
    currentYearOrders = null,
    previousYearOrders = null,
    useAmount = false
) {
    const labels = window.monthly_graph_data;
    new Chart(idToDisplay, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Current Year Amount",
                    data: currentYearSales,
                    backgroundColor: "rgba(200, 200, 200, 0.8)",
                    borderRadius: 4,
                    barThickness: 13,
                },
                {
                    label: "Previous Year Amount",
                    data: previousYearSales,
                    backgroundColor: "rgb(218 120 38)",
                    borderRadius: 4,
                    barThickness: 13,
                },
                {
                    label: "Current Year Order",
                    data: currentYearOrders,
                    backgroundColor: "rgba(0, 123, 255, 0.6)",
                    borderRadius: 4,
                    barThickness: 13,
                },
                {
                    label: "Previous Year Order",
                    data: previousYearOrders,
                    backgroundColor: "rgba(40, 167, 69, 0.6)",
                    borderRadius: 4,
                    barThickness: 13,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Sales Amount",
                    },
                    ticks: {
                        color: "#666",
                        callback: function (value) {
                            // Format only for Amount datasets
                            if (useAmount) {
                                if (value >= 1000000) {
                                    return (value / 1000000).toFixed(1) + "M";
                                } else if (value >= 1000) {
                                    return (value / 1000).toFixed(1) + "K";
                                }
                            }
                            return value;
                        },
                    },
                },
                x: {
                    title: { display: true, text: "Months" },
                    ticks: {
                        color: "#a10000",
                        font: { weight: "bold" },
                    },
                },
            },
        },
    });
}
/**code end of bar chart */

/**Sweet alert on delete button
 * code start */
$(document).on("click", ".delete-btn", function (event) {
    event.preventDefault();
    const actionUrl = $(this).data("url");
    Swal.fire({
        title: delete_modal_title,
        text: delete_modal_text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: confirm_button_modal,
        cancelButtonText: cancel,
        confirmButtonColor: "",
        cancelButtonColor: "",
        customClass: {
            title: "delete-modal-title",
            icon: "warning-icon mt-0",
            confirmButton:
                "confirm-button-class border-primary btn btn-primary px-4 fw-semibold",
            cancelButton:
                "cancel-button-class px-4 btn btn-secondary fw-semibold",
            popup: "rounded-3 py-8",
        },
        didRender: function () {
            $(".swal2-html-container").addClass("py-2");
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: actionUrl,
                type: "GET",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your item has been deleted.",
                            icon: "success",
                            customClass: {
                                title: "delete-modal-title text-secondary mt-0",
                                popup: "rounded-3 py-8",
                                confirmButton:
                                    "confirm-button-ok confirm-button-class border-primary btn btn-primary px-8 fw-semibold",
                                icon: "warning-icon-delete-modal mt-0",
                            },
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text:
                                response.message ||
                                "Unable to delete customer.",
                            icon: "error",
                        });
                    }
                },
            });
        }
    });
});
/**code end */


// Notification Sidebar Toggle
$(document).ready(function () {

    // Open Sidebar
    $("#notificationToggle").on("click", function () {
        $("#notificationCanvas").addClass("open");
        $("#overlay").fadeIn(200);
    });

    // Close Sidebar
    $(".closeCanvas, #overlay").on("click", function () {
        $("#notificationCanvas").removeClass("open");
        $("#overlay").fadeOut(200);
    });

});

