export default function getWordPressData(moduleName) {
    const dataContainer = document.getElementById(`wp-script-module-data-${moduleName}`);

    if ( dataContainer ) {
        try {
            return JSON.parse( dataContainer.textContent );
        } catch {}
    }

    return {};
}
