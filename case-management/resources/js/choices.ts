import Choices from "choices.js";

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Helper for dot notation (e.g., "person.full_name")
function getNestedValue(obj, path, defaultValue = "Unknown") {
    return path
        .split(".")
        .reduce(
            (acc, part) =>
                acc && acc[part] !== undefined ? acc[part] : defaultValue,
            obj
        );
}

export function initializeChoicesSelects() {
    const elements = document.querySelectorAll(".choices-select");

    elements.forEach((el) => {
        console.log(el);
        const url = el.dataset.url;
        const labelKey = el.dataset.labelKey || "name";
        const isMultiple = el.hasAttribute("multiple");
        const placeholder = el.getAttribute("placeholder") || "Search...";
        const noteType = el.dataset.noteType;

        const choices = new Choices(el, {
            removeItemButton: true,
            searchEnabled: true,
            searchChoices: false,
            searchFields: ["label"],
            shouldSort: false,
            placeholderValue: placeholder,
            noResultsText: "No results found",
            noChoicesText: "No choices to choose from",
            itemSelectText: "",
            loadingText: "Loading...",
            maxItemCount: isMultiple ? -1 : 1,
        });

        let currentPage = 1;
        let searchTerm = "";
        let hasMore = false;
        let isLoading = false;

        const loadPage = async (append = false) => {
            if (isLoading || !url || searchTerm.length < 1) return;

            isLoading = true;

            if (!append) {
                choices.clearChoices();
                choices.setChoices(
                    [{ value: "", label: "Loading...", disabled: true }],
                    "value",
                    "label",
                    true
                );
            }

            try {
                const response = await fetch(
                    `${url}?q=${encodeURIComponent(
                        searchTerm
                    )}&page=${currentPage}&noteType=${encodeURIComponent(
                        noteType
                    )}`
                );
                const data = await response.json();

                const newChoices = data.items.map((item) => ({
                    value: item.id,
                    label:
                        getNestedValue(item, labelKey) ||
                        item.name ||
                        item.title ||
                        "Unknown",
                }));

                choices.setChoices(
                    newChoices,
                    "value",
                    "label",
                    append ? false : true
                );

                currentPage++;
                hasMore = data.current_page < data.last_page;
            } catch (error) {
                console.error("Error fetching choices:", error);
                choices.setChoices(
                    [
                        {
                            value: "",
                            label: "Error loading results",
                            disabled: true,
                        },
                    ],
                    "value",
                    "label",
                    true
                );
            } finally {
                isLoading = false;
            }
        };

        const debouncedSearch = debounce((value) => {
            searchTerm = value;
            currentPage = 1;
            hasMore = true;
            loadPage();
        }, 250);

        el.addEventListener("search", (event) => {
            const { value } = event.detail;
            if (value.length >= 1) {
                debouncedSearch(value);
            } else {
                choices.clearChoices();
            }
        });

        const dropdown = choices.dropdown.element;
        dropdown.addEventListener("scroll", () => {
            if (isLoading || !hasMore) return;
            const { scrollTop, scrollHeight, clientHeight } = dropdown;
            if (scrollTop + clientHeight >= scrollHeight - 20) {
                loadPage(true);
            }
        });
    });
}
