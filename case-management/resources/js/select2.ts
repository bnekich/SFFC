import $ from "jquery";
import Select2 from "select2";
import "select2/dist/css/select2.min.css";

// declare global {
//     interface Window {
//         jQuery: typeof $;
//         $: typeof $;
//     }
// }
// window.$ = window.jQuery = $;

// declare const Select2: {
//     (jQuery: JQueryStatic): void;
// };
// Select2($);

// interface Select2Result {
//     id: number;
//     text: string;
// }

// interface Select2Response {
//     results: Select2Result[];
//     pagination: {
//         more: boolean;
//     };
// }

// export function initializeFamilySelect2(): void {
//     if ($(".family-select").length) {
//         // Only run if element exists
//         $(".family-select").select2({
//             placeholder: "Search for families...",
//             allowClear: true,
//             minimumInputLength: 1,
//             ajax: {
//                 url: "/familySearch",
//                 dataType: "json",
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         q: params.term,
//                         page: params.page || 1,
//                     };
//                 },
//                 processResults: function (data) {
//                     return {
//                         results: data.items.map(function (item) {
//                             return {
//                                 id: item.id,
//                                 text: item.family_name,
//                             };
//                         }),
//                         pagination: {
//                             more: data.current_page < data.last_page,
//                         },
//                     };
//                 },
//             },
//         });
//     }
// }

// $(document).ready(() => {
//     initializeFamilySelect2();
// });

// export function initializePersonSelect2(): void {
//     if ($(".person-select").length) {
//         // Only run if element exists
//         $(".person-select").select2({
//             placeholder: "Search for people...",
//             allowClear: true,
//             minimumInputLength: 1,
//             ajax: {
//                 url: "/peopleSearch",
//                 dataType: "json",
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         q: params.term,
//                         page: params.page || 1,
//                     };
//                 },
//                 processResults: function (data) {
//                     return {
//                         results: data.items.map(function (item) {
//                             return {
//                                 id: item.id,
//                                 text: item.last_name + ", " + item.first_name,
//                             };
//                         }),
//                         pagination: {
//                             more: data.current_page < data.last_page,
//                         },
//                     };
//                 },
//             },
//         });
//     }
// }

// $(document).ready(() => {
//     initializePersonSelect2();
// });

// export function initializeCaseSelect2(): void {
//     if ($(".case-select").length) {
//         // Only run if element exists
//         $(".case-select").select2({
//             placeholder: "Search for cases...",
//             allowClear: true,
//             minimumInputLength: 1,
//             ajax: {
//                 url: "/api/noteables?type=cases",
//                 dataType: "json",
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         q: params.term,
//                         page: params.page || 1,
//                     };
//                 },
//                 processResults: function (data) {
//                     return {
//                         results: data.items.map(function (item) {
//                             return {
//                                 id: item.id,
//                                 text: item.case_identifier,
//                             };
//                         }),
//                         pagination: {
//                             more: data.current_page < data.last_page,
//                         },
//                     };
//                 },
//             },
//         });
//     }
// }

// $(document).ready(() => {
//     initializeCaseSelect2();
// });

// export function initializeVolunteerSelect2(): void {
//     if ($(".volunteer-select").length) {
//         // Only run if element exists
//         $(".volunteer-select").select2({
//             placeholder: "Search for volunteers...",
//             allowClear: true,
//             minimumInputLength: 1,
//             ajax: {
//                 url: "/api/noteables?type=volunteers",
//                 dataType: "json",
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         q: params.term,
//                         page: params.page || 1,
//                     };
//                 },
//                 processResults: function (data) {
//                     return {
//                         results: data.items.map(function (item) {
//                             return {
//                                 id: item.id,
//                                 text: item.last_name + ", " + item.first_name,
//                             };
//                         }),
//                         pagination: {
//                             more: data.current_page < data.last_page,
//                         },
//                     };
//                 },
//             },
//         });
//     }
// }

// $(document).ready(() => {
//     initializeVolunteerSelect2();
// });
