// Extend the Window interface to include jQuery and $
declare global {
    interface Window {
        jQuery: typeof $;
        $: typeof $;
    }
}

export {}; // This ensures the file is treated as a module.
