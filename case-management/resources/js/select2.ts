import $ from "jquery";
import Select2 from "select2";
import "select2/dist/css/select2.min.css";

declare global {
    interface Window {
        jQuery: typeof $;
        $: typeof $;
    }
}
window.$ = window.jQuery = $;

declare const Select2: {
    (jQuery: JQueryStatic): void;
};
Select2($);

interface Select2Result {
    id: number;
    text: string;
}

interface Select2Response {
    results: Select2Result[];
    pagination: {
        more: boolean;
    };
}

export function initializeOrgSelect2(): void {
    if ($(".org-select").length) {
        $(".org-select").select2({
            placeholder: "Search for organizations...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/orgSearch",
                dataType: "json",
                delay: 250,
                data: (params: { term: string; page: number }) => ({
                    q: params.term,
                    page: params.page || 1,
                }),
                processResults: (data: {
                    items: { id: number; name: string }[];
                    current_page: number;
                    last_page: number;
                }): Select2Response => ({
                    results: data.items.map((item) => ({
                        id: item.id,
                        text: item.name,
                    })),
                    pagination: {
                        more: data.current_page < data.last_page,
                    },
                }),
            },
        });
    }
}

$(document).ready(() => {
    initializeOrgSelect2();
});

export function initializeFamilySelect2(): void {
    if ($(".family-select").length) {
        // Only run if element exists
        $(".family-select").select2({
            placeholder: "Search for families...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/familySearch",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.family_name,
                            };
                        }),
                        pagination: {
                            more: data.current_page < data.last_page,
                        },
                    };
                },
            },
        });
    }
}

$(document).ready(() => {
    initializeFamilySelect2();
});

$(document).ready(() => {
    initializeOrgSelect2();
});

export function initializePersonSelect2(): void {
    if ($(".person-select").length) {
        // Only run if element exists
        $(".person-select").select2({
            placeholder: "Search for people...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/peopleSearch",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.last_name + ", " + item.first_name,
                            };
                        }),
                        pagination: {
                            more: data.current_page < data.last_page,
                        },
                    };
                },
            },
        });
    }
}

$(document).ready(() => {
    initializePersonSelect2();
});
