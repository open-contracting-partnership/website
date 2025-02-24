import { Timeline } from '@knight-lab/timelinejs';

document.addEventListener('DOMContentLoaded', function() {
    const timelineElement = document.getElementById('timeline-embed');
    
    if (!timelineElement) {
        console.error('Timeline element not found');
        return;
    }

    const googleSheetUrl = timelineElement.dataset.url;
    
    if (!googleSheetUrl) {
        console.error('Google Sheet URL not provided');
        return;
    }

    try {
        new Timeline('timeline-embed', googleSheetUrl, {
            height: timelineElement.style.height || '600px',
            width: timelineElement.style.width || '100%'
        });
    } catch (error) {
        console.error('Failed to initialize timeline:', error);
    }
});