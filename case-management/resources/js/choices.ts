import Choices from "choices.js";

// Interface for a single item from the API response
interface ApiItem {
    id: number | string;
    name?: string;
    title?: string;
    [key: string]: any; // Allows for other dynamic properties
}

// Interface for the paginated API response structure
interface PaginatedApiResponse {
    items: ApiItem[];
    current_page: number;
    last_page: number;
}

function debounce<T extends (...args: any[]) => any>(
    func: T,
    wait: number
): (...args: Parameters<T>) => void {
    let timeout: ReturnType<typeof setTimeout>;

    return function executedFunction(...args: Parameters<T>): void {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Helper for dot notation (e.g., "person.full_name")
function getNestedValue(
    obj: Record<string, any>,
    path: string,
    defaultValue: any = "Unknown"
): any {
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
        const htmlElement = el as HTMLElement;
        let url = htmlElement.dataset.url;
        const labelKey = htmlElement.dataset.labelKey || "name";
        const isMultiple = htmlElement.hasAttribute("multiple");
        const placeholder =
            htmlElement.getAttribute("placeholder") || "Search...";
        const noteType = htmlElement.dataset.noteType;

        // Ensure the URL uses HTTPS
        if (url && !url.startsWith("http")) {
            // If URL is relative (e.g., "/familySearch"), keep it relative to inherit HTTPS
            url = url.startsWith("/") ? url : `/${url}`;
        } else if (url && url.startsWith("http://")) {
            // Force HTTPS if HTTP is explicitly used
            url = url.replace("http://", "https://");
        }
        console.log(url);
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
                        noteType || ""
                    )}`
                );
                const data: PaginatedApiResponse = await response.json();
                console.log(data);

                const newChoices = data.items.map((item: ApiItem) => ({
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

        htmlElement.addEventListener("search", (event) => {
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
