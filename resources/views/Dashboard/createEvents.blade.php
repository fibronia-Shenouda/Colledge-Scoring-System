{{-- @extends('Dashboard.layout')

@section('title')
    Create Event
@endsection

@section('content')
    <style>
        textarea {
            margin-top: 1%;
        }
    </style>
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="message">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h2>Create Event</h2>
        </div>
        <hr>

        <form method="POST" action="/add/competition/events/create" id="form">
            <div class="competition">
                <input type="hidden" value = "{{ $competition_name }}" name="competition_name">
                <input type="hidden" value = "{{ $competition_photo }}" name="competition_image">
                <input type="hidden" value = "{{ $competition_description }}" name="competition_desc">
                <input type="hidden" value="{{ $competition_category }}" name="competition_category">
                <input type="hidden" id="event-numer-value" name="events_number">
            </div>
            @csrf
            @method('POST')
            <div class="fields">
                <div id="inputFieldsContainer">
                    <!-- Form fields will be added here -->
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-between">
                        <div id="start">
                            <h2 style="font-size: 3vh;text-align:center">Add</h2>
                            <i class="bi bi-plus-circle-fill btn-add-event" id="addNewFormBtn"></i>
                        </div>
                        <div id="end" style="display: none">
                            <h2 style="font-size: 3vh;text-align:center">Add</h2>
                            <i class="bi bi-check-circle btn-add-event" id="done"></i>
                        </div>
                    </div>
                    <button id="submit" type="submit" class="add-events text-white"><i
                            class="bi bi-plus"></i> Add Competition</button>
                </div>
            </div>
        </form>

    </div>
    </div>

    <script src="{{ asset('./main.js') }}"></script>
    <script>
        // Event count
        var count = 0;

        // Function to display error
        function showAlert(message) {
            // Create a the error
            const errorMsg = document.createElement('p');
            errorMsg.style.color = "red";
            errorMsg.style.textAlign = "start";
            errorMsg.style.fontSize = "12px";
            errorMsg.style.marginLeft = "2%";
            errorMsg.textContent = message;

            // Append the error to the container
            const container = document.getElementById('inputFieldsContainer');
            container.parentNode.insertBefore(errorMsg, container.nextSibling);
        }


        // Function to store form data in local storage
        function storeFormData(name, description, category) {
            let events = JSON.parse(localStorage.getItem('events')) || [];
            events.push({
                'id': count,
                'name': name,
                'description': description,
                'category': category
            });
            localStorage.setItem('events', JSON.stringify(events));
        }

        // Function to add a new input form
        var fisrtClick = true;

        function addInputForm() {
            if (fisrtClick) {
                fisrtClick = false
                count++;

                if (count >= 5) {
                    document.getElementById('end').style.display = "inline";
                    document.getElementById('start').style.display = "none";
                }

                // Store form data from previous input fields
                const inputs = document.querySelectorAll(
                    '#inputFieldsContainer input[type="text"], #inputFieldsContainer textarea, #inputFieldsContainer input[type="radio"]:checked'
                );

                if (inputs.length > 0) {
                    storeFormData(
                        inputs[inputs.length - 3].value, // Name
                        inputs[inputs.length - 2].value, // Description
                        inputs[inputs.length - 1].value // Category
                    );
                }

                // Name input
                const nameInput = document.createElement('input');
                nameInput.type = "text";
                nameInput.placeholder = "Name";
                nameInput.name = "name" + count;
                nameInput.classList.add('form-control');


                // Description input
                const descriptionInput = document.createElement('textarea');
                descriptionInput.placeholder = "Description";
                descriptionInput.name = "description" + count;
                descriptionInput.classList.add('form-control');


                // Radio Input
                const categoryInput1 = document.createElement('input');
                categoryInput1.type = "radio";
                categoryInput1.name = "category" + count;
                categoryInput1.value = "0";
                categoryInput1.checked = true;


                const categoryInput2 = document.createElement('input');
                categoryInput2.type = "radio";
                categoryInput2.name = "category" + count;
                categoryInput2.value = "1";


                // Create a div to contain the input fields
                const div = document.createElement('div');
                div.classList.add('form-group');
                div.appendChild(nameInput);
                div.appendChild(descriptionInput);
                div.appendChild(categoryInput1);
                div.appendChild(document.createTextNode("Sport"));
                div.appendChild(categoryInput2);
                div.appendChild(document.createTextNode("Academic"));

                // Append the div to the container
                document.getElementById('inputFieldsContainer').appendChild(div);
            } else {
                // Store form data from previous input fields
                const inputs = document.querySelectorAll(
                    '#inputFieldsContainer input[type="text"], #inputFieldsContainer textarea, #inputFieldsContainer input[type="radio"]:checked'
                );

                // Check if the event already exists in local storage
                let events = JSON.parse(localStorage.getItem('events')) || [];
                const eventExists = events.some(event =>
                    event.name === inputs[inputs.length - 3].value.trim()
                );

                if (eventExists) {
                    showAlert('Event already exists!');

                } else {
                    // Proceed if all fields are filled
                    let allFieldsFilled = true;
                    inputs.forEach(input => {
                        // For text and textarea inputs
                        if (input.type === "text" || input.tagName.toLowerCase() === "textarea") {
                            if (input.value.trim() === "") {
                                allFieldsFilled = false;
                            }
                        }
                        // For radio inputs
                        if (input.type === "radio") {
                            const radioGroup = document.querySelectorAll(`input[name="${input.name}"]:checked`);
                            if (radioGroup.length === 0) {
                                allFieldsFilled = false;
                            }
                        }
                    });
                    if (allFieldsFilled) {
                        count++;

                        if (count >= 5) {
                            document.getElementById('end').style.display = "inline";
                            document.getElementById('start').style.display = "none";
                        }

                        // Store form data from previous input fields
                        const inputs = document.querySelectorAll(
                            '#inputFieldsContainer input[type="text"], #inputFieldsContainer textarea, #inputFieldsContainer input[type="radio"]:checked'
                        );

                        if (inputs.length > 0) {
                            storeFormData(
                                inputs[inputs.length - 3].value, // Name
                                inputs[inputs.length - 2].value, // Description
                                inputs[inputs.length - 1].value // Category
                            );
                        }

                        // Name input
                        const nameInput = document.createElement('input');
                        nameInput.type = "text";
                        nameInput.placeholder = "Name";
                        nameInput.name = "name" + count;
                        nameInput.classList.add('form-control');


                        // Description input
                        const descriptionInput = document.createElement('textarea');
                        descriptionInput.placeholder = "Description";
                        descriptionInput.name = "description" + count;
                        descriptionInput.classList.add('form-control');


                        // Radio Input
                        const categoryInput1 = document.createElement('input');
                        categoryInput1.type = "radio";
                        categoryInput1.name = "category" + count;
                        categoryInput1.value = "0";
                        categoryInput1.checked = true;


                        const categoryInput2 = document.createElement('input');
                        categoryInput2.type = "radio";
                        categoryInput2.name = "category" + count;
                        categoryInput2.value = "1";


                        // Create a div to contain the input fields
                        const div = document.createElement('div');
                        div.classList.add('form-group');
                        div.appendChild(nameInput);
                        div.appendChild(descriptionInput);
                        div.appendChild(categoryInput1);
                        div.appendChild(document.createTextNode("Sport"));
                        div.appendChild(categoryInput2);
                        div.appendChild(document.createTextNode("Academic"));

                        // Append the div to the container
                        document.getElementById('inputFieldsContainer').appendChild(div);
                    } else {
                        showAlert('Please fill in all fields!');
                    }
                }
            }
        }

        // Event listener for adding new form
        document.getElementById('addNewFormBtn').addEventListener('click', addInputForm);

        // Store the last input value
        document.getElementById("done").addEventListener('click', function() {
            // Store form data from previous input fields
            const inputs = document.querySelectorAll(
                '#inputFieldsContainer input[type="text"], #inputFieldsContainer textarea, #inputFieldsContainer input[type="radio"]:checked'
            );

            // Extract name input value
            const nameValue = inputs[inputs.length - 3].value.trim();

            // Check if the event name already exists in local storage
            let events = JSON.parse(localStorage.getItem('events')) || [];
            const nameExists = events.some(event => event.name === nameValue);

            if (nameExists) {
                showAlert('Event already exists!');
            } else {
                // Proceed with checking if all fields are filled
                let allFieldsFilled = true;
                inputs.forEach(input => {
                    // For text and textarea inputs
                    if (input.type === "text" || input.tagName.toLowerCase() === "textarea") {
                        if (input.value.trim() === "") {
                            allFieldsFilled = false;
                        }
                    }
                    // For radio inputs
                    if (input.type === "radio") {
                        const radioGroup = document.querySelectorAll(`input[name="${input.name}"]:checked`);
                        if (radioGroup.length === 0) {
                            allFieldsFilled = false;
                        }
                    }
                });

                // Proceed if all fields are filled
                if (allFieldsFilled) {
                    storeFormData(
                        inputs[inputs.length - 3].value.trim(), // Name
                        inputs[inputs.length - 2].value.trim(), // Description
                        inputs[inputs.length - 1].value.trim() // Category
                    );
                    document.getElementById("submit").style.display = "inline";
                    document.getElementById("end").style.display = "none";
                } else {
                    showAlert('Please fill in all fields!');
                }
            }

        });

        // Get from local storage when refresh
        document.addEventListener('DOMContentLoaded', getEvents);

        function getEvents() {
            var id = 0;

            JSON.parse(localStorage.getItem('events')).forEach(event => {
                count++;
            });

            if (count >= 5) {
                document.getElementById('end').style.display = "inline";
                document.getElementById('start').style.display = "none";
            }


            let events;
            if (localStorage.getItem('events') === null) {
                events = [];
            } else {
                events = JSON.parse(localStorage.getItem('events'));
            }

            events.forEach((event, index) => {
                id++;

                // Create input fields
                const nameInput = document.createElement('input');
                nameInput.type = "text";
                nameInput.value = event.name;
                nameInput.classList.add('form-control');


                const descriptionInput = document.createElement('textarea');
                descriptionInput.value = event.description;
                descriptionInput.classList.add('form-control');


                const categoryInput1 = document.createElement('input');
                categoryInput1.type = "radio";
                categoryInput1.name = "category" + id;
                categoryInput1.value = "0";
                if (event.category === "0") {
                    categoryInput1.checked = true;
                }

                const categoryInput2 = document.createElement('input');
                categoryInput2.type = "radio";
                categoryInput2.name = "category" + id;
                categoryInput2.value = "1";
                if (event.category === "1") {
                    categoryInput2.checked = true;
                }


                // Radios contaoner
                const radios = document.createElement("div");
                radios.style.color = "#194185";

                // Container div for radios, edit
                const bottomDiv = document.createElement('div');
                bottomDiv.style.display = "flex";
                bottomDiv.style.justifyContent = "space-between";
                bottomDiv.style.borderBottom = "1px solid gray";
                bottomDiv.style.padding = "15px";

                // Create a div to contain the input fields
                const div = document.createElement('div');
                div.classList.add('form-group');
                div.appendChild(nameInput);
                div.appendChild(descriptionInput);
                radios.appendChild(categoryInput1);
                radios.appendChild(document.createTextNode("Sport "));
                radios.appendChild(categoryInput2);
                radios.appendChild(document.createTextNode("Academic"));
                bottomDiv.appendChild(radios);
                div.appendChild(bottomDiv);

                // Append the div to the container
                document.getElementById('inputFieldsContainer').appendChild(div);
            });
        }

        function editEvent(id) {
            const events = JSON.parse(localStorage.getItem('events'));
            if (events && Array.isArray(events) && id >= 0 && id < events.length) {
                let data = events[id].name;
                console.log(data);
            } else {
                console.error('Invalid id or events array is empty or not properly formatted.');
            }
        }


        document.getElementById('clear').addEventListener('click', function() {
            localStorage.removeItem('events'); // Remove data from local storage

            // Clear all input fields
            const container = document.getElementById('inputFieldsContainer');
            container.innerHTML = ''; // Remove all child elements
        });
    </script>
@endsection

Lorem ipsum dolor sit amet consectetur, adipisbicing elit. Cum, doloribus deleniti, modi aspernatur dicta ipsum ipsam distinctio at aperiam culpa nobis excepturi corrupti eaque nisi quos? Quae doloribus ut assumenda? Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sint ut ea laboriosam necessitatibus eum natus officia adipisci molestiae quisquam aperiam, numquam fugiat sapiente, a sequi. Atque placeat inventore exercitationem! Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae inventore, incidunt expedita perferendis, aspernatur sequi cumque, explicabo quo exercitationem ipsa soluta. Totam ipsam fugit dolores? Rem repellendus consequuntur est modi. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum ex assumenda eaque molestias incidunt enim corporis quas laboriosam. Laudantium ipsam atque aut nobis facilis doloribus. Reiciendis quibusdam consectetur facilis cumque! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae excepturi fugit vitae aperiam optio suscipit porro, voluptates doloremque, temporibus minima voluptatibus quasi. Sint nesciunt quisquam, quasi architecto nisi cum debitis! --}}

@extends('Dashboard.layout')

@section('title')
    Create Event
@endsection

@section('content')
    <style>
        textarea {
            margin-top: 1%;
        }
    </style>
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="message">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h2>Create Event</h2>
        </div>
        <hr>

        <form method="POST" action="/add/competition/events/create" id="form">
            @csrf
            @method('POST')
            <div class="competition">
                <input type="hidden" value="{{ $competition_id }}" name="competition_id">
            </div>
            <div class="fields">
                {{-- Event 1 --}}
                <div id="event1">
                    <h2 style="font-size: 3.5vh">Event 1</h2>
                    <hr>
                    <div class="form-group">
                        <label>Event Name</label>
                        <input type="text" class="form-control" placeholder="Enter event name" name="name1"
                            value="{{ old('name1') }}">
                        @error('name1')
                            <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div>
                            <label>Event Description</label>
                            <textarea class="form-control" placeholder="Enter the event description" name="description1" cols="30"
                                rows="5">{{ old('description1') }}</textarea>
                            @error('description1')
                                <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group d-flex">
                            <div class="mt-2" style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                <div>
                                    <input type="radio" name="is_academic1" value="1" checked> Academic
                                </div>
                                <div>
                                    <input type="radio" name="is_academic1" value="0"> Sport
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- Event 2 --}}
                    <div id="event2">
                        <h2 style="font-size: 3.5vh">Event 2</h2>
                        <hr>
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" class="form-control" placeholder="Enter event name" name="name2"
                                value="{{ old('name2') }}">
                            @error('name2')
                                <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Event Description</label>
                                <textarea class="form-control" name="description2" placeholder="Enter the event description" cols="30"
                                    rows="5">{{ old('description2') }}</textarea>
                                @error('description2')
                                    <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group d-flex">
                                <div class="mt-2" style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                    <div>
                                        <input type="radio" name="is_academic2" value="1" checked> Academic
                                    </div>
                                    <div>
                                        <input type="radio" name="is_academic2" value="0"> Sport
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{-- Event 3 --}}
                        <div id="event3">
                            <h2 style="font-size: 3.5vh">Event 3</h2>
                            <hr>
                            <div class="form-group">
                                <label>Event Name</label>
                                <input type="text" class="form-control" placeholder="Enter event name" name="name3"
                                    value="{{ old('name3') }}">
                                @error('name3')
                                    <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div>
                                    <label>Event Description</label>
                                    <textarea class="form-control" name="description3" placeholder="Enter the event description" cols="30"
                                        rows="5">{{ old('description3') }}</textarea>
                                    @error('description3')
                                        <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group d-flex">
                                    <div class="mt-2"
                                        style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                        <div>
                                            <input type="radio" name="is_academic3" value="1" checked> Academic
                                        </div>
                                        <div>
                                            <input type="radio" name="is_academic3" value="0"> Sport
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            {{-- Event 4 --}}
                            <div id="event4">
                                <h2 style="font-size: 3.5vh">Event 4</h2>
                                <hr>
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <input type="text" class="form-control" placeholder="Enter event name"
                                        name="name4" value="{{ old('name4') }}">
                                    @error('name4')
                                        <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Event Description</label>
                                        <textarea class="form-control" name="description4" placeholder="Enter the event description" cols="30"
                                            rows="5">{{ old('description4') }}</textarea>
                                        @error('description4')
                                            <p class="text-danger" style="font-size: 15px;text-align:start">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="mt-2"
                                            style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                            <div>
                                                <input type="radio" name="is_academic4" value="1" checked>
                                                Academic
                                            </div>
                                            <div>
                                                <input type="radio" name="is_academic4" value="0"> Sport
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                {{-- Event 5 --}}
                                <div id="event5">
                                    <h2 style="font-size: 3.5vh">Event 5</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label>Event Name</label>
                                        <input type="text" class="form-control" placeholder="Enter event name"
                                            name="name5" value="{{ old('name5') }}">
                                        @error('name5')
                                            <p class="text-danger" style="font-size: 15px;text-align:start">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label>Event Description</label>
                                            <textarea class="form-control" name="description5" placeholder="Enter the event description" cols="30"
                                                rows="5">{{ old('description5') }}</textarea>
                                            @error('description5')
                                                <p class="text-danger" style="font-size: 15px;text-align:start">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-2"
                                            style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                            <div>
                                                <input type="radio" name="is_academic5" value="1" checked>
                                                Academic
                                            </div>
                                            <div>
                                                <input type="radio" name="is_academic5" value="0"> Sport
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Submit button --}}
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="add-events text-white"><i class="bi bi-plus" style="font-size: 20px"></i>
                                            Add
                                            Events</button>
                                    </div>
                                </div>
        </form>
    </div>
    </div>
    <script src="{{ asset('./main.js') }}"></script>
@endsection