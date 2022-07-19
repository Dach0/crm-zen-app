<div class="px-96 items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @foreach($resourceItems as $item)
        <div class="pt-4">
            <x-list-item :item="$item"/>
        </div>
    @endforeach
</div>
<script>
    const copyButtonLabel = "Copy Code";

    // you can use a class selector instead if you, or the syntax highlighting library adds one to the 'pre'.
    let blocks = document.querySelectorAll("pre");

    blocks.forEach((block) => {
        // only add button if browser supports Clipboard API
        if (navigator.clipboard) {
            let button = document.createElement("button");
            button.innerText = copyButtonLabel;
            button.addEventListener("click", copyCode);
            button.classList.add("snippet");
            block.appendChild(button);
        }
    });

    async function copyCode(event) {
        const button = event.srcElement;
        const pre = button.parentElement;
        let code = pre.querySelector("code");
        let text = code.innerText;
        await navigator.clipboard.writeText(text);

        button.innerText = "Code Copied";

        setTimeout(() => {
            button.innerText = copyButtonLabel;
        }, 1000)
    }
</script>
