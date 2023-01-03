class GIFImage {
    static get toolbox() {
        return {
            title: 'GIF',
            icon: '<svg width="17" height="15" viewBox="0 0 336 276" xmlns="http://www.w3.org/2000/svg"><path d="M291 150V79c0-19-15-34-34-34H79c-19 0-34 15-34 34v42l67-44 81 72 56-29 42 30zm0 52l-43-30-56 30-81-67-66 39v23c0 19 15 34 34 34h178c17 0 31-13 34-29zM79 0h178c44 0 79 35 79 79v118c0 44-35 79-79 79H79c-44 0-79-35-79-79V79C0 35 35 0 79 0z"/></svg>'
        };
    }

    render() {

        this.wrapper = document.createElement('div');

        this._createModal();

        return this.wrapper;
    }

    _createModal(){

        const modal = document.createElement('div');
        const modalDialog = document.createElement('div');
        const modalContent = document.createElement('div');
        const modalBody = document.createElement('div');
        const modalFooter = document.createElement('div');

        const input = document.createElement('input');
        const insertBtn = document.createElement('button');
        const valueOfGif = document.createElement('p');
        // valueOfGif.classList.add('selected-embed-url');

        let selectedEmbed = '';
        //
        modal.classList.add('modal', 'fade', 'show');
        modalDialog.classList.add('modal-dialog');
        modalContent.classList.add('modal-content');
        modalBody.classList.add('modal-body', 'row', 'col-md-12');
        input.classList.add('form-control');
        insertBtn.classList.add('btn', 'btn-primary', 'm-1');

        modalBody.appendChild(input);
        modalFooter.appendChild(insertBtn);
        modalContent.appendChild(modalBody);
        modalContent.appendChild(modalFooter);
        modalDialog.appendChild(modalContent);
        modal.appendChild(modalDialog);
        //
        insertBtn.innerText = 'Insert';
        input.placeholder = 'Search GIF...';
        modal.style.display = 'block';

        insertBtn.addEventListener('click', function (evt) {
            evt.preventDefault();
            modal.style.display = 'none';
            selectedEmbed = document.querySelector('.selected-gif:checked').value;
            valueOfGif.innerText = selectedEmbed;
        });

        // search words on change
        input.addEventListener('input', async function (evt) {
            if (this.value.length >= 3) {
                let provider = new GifyProvider(this.value, 10);
                let res = await provider.search();
                if (res) {
                    for (let element in res.data.data) {
                        const divEmbedInput = document.createElement('div');
                        divEmbedInput.classList.add('col-md-4', 'm-1');
                        const embedInput = document.createElement('input');
                        embedInput.classList.add('selected-gif');
                        embedInput.type = 'checkbox';
                        embedInput.value = res.data.data[element].embed_url;
                        const embed = document.createElement('embed');
                        embed.src = res.data.data[element].embed_url;
                        embed.width = 100;
                        embed.height = 100;
                        divEmbedInput.appendChild(embed);
                        divEmbedInput.appendChild(embedInput);
                        modalBody.appendChild(divEmbedInput);
                    }
                }
            }
        });// end of event of search words

        this.wrapper.appendChild(modal);
        this.wrapper.appendChild(valueOfGif);
    }

    save(blockContent) {
        const selectedEmbedUrl = blockContent.querySelector('p');
        return {
            gifUrl: selectedEmbedUrl.innerText
        }
    }
}
