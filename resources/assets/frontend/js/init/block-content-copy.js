window.initBlockContentCopy = function () {

    let blockPrintScreen = document.getElementById('block-print-screen');

    blockPrintScreen.style.display = 'none';

    window.addEventListener('keydown', (event) => {
        if (event.keyCode === 16) {

            blockPrintScreen.style.display = 'block';
            document.execCommand('copy');
        }
    });

    window.addEventListener('keyup', (event) => {
        if (event.code === 'PrintScreen' || event.keyCode === 44 || event.keyCode === 42) {

            blockPrintScreen.style.display = 'block';
            document.execCommand('copy');

            setTimeout(() => {
                blockPrintScreen.style.display = 'none';
            }, 500);
        }

        if (event.keyCode === 16) {

            setTimeout(() => {
                blockPrintScreen.style.display = 'none';
            }, 500);
        }
    });

    document.addEventListener('copy', () => {
        copyTextToClipboard('Conteúdo protegido contra cópia, acesse: ' + document.location.href)
    });

    let fallbackCopyTextToClipboard = (text) => {
        let textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            let successful = document.execCommand('copy');
            let msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
        } catch (err) {
            console.error('Unable to copy: ', err);
        }

        document.body.removeChild(textArea);
    };

    let copyTextToClipboard = (text) => {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(() => {
            console.log('Copying to clipboard was successful!');
        }, (err) => {
            console.error('Could not copy text: ', err);
        });
    };

};