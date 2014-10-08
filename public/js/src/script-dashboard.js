$(document).ready(function(){

// Terminal state
var terminalVisibility = false;
// Terminal buffer
var terminalBuffer = [];
// Terminal buffer index
var bufferIndex = 0;
// Terminal buffer size
var bufferSize = 3;
// Device
var device = "";
// Send command encrypted
var sendEncrypted = false;


// Nav terminal toggle
$("#btn-terminal").click(function()
{
	if(terminalVisibility)
	{
		$(".terminal").css("bottom", "-200px");
		$(".terminal").css("height", "200px");
		terminalVisibility = false;
	}
	else
	{
		$(".terminal").css("bottom", "0px");
		$(".terminal-input").focus();
		terminalVisibility = true;
	}
});


// Terminal send command
$(".terminal-input").keyup(function(e)
{
	if(e.keyCode == 13)
	{
		// Command to send
		var command = $(".terminal-input").val();

		// Select a device
		if(command.substring(0, 13) == 'selectDevice:')
		{
			$.post("/terminal/selectDevice", {dev: command.substring(13)}, function(data) {
				if(data.code == "0")
				{
					device = command.substring(13);
					appendTerminalLog(command, "Device selected");
				}
				else if(data.code == "1")
				{
					appendTerminalLog(command, "The device does not exist");
				}
				else
				{
					appendTerminalLog(command, "Internal error");
				}
			});
		}

		// Send data encrypted
		else if(command.substring(0, 14) == 'sendEncrypted:')
		{
			if(command.substring(14) == "true")
			{
				sendEncrypted = true;
				appendTerminalLog(command, "Now data will be sent encrypted");
			}
			else if(command.substring(14) == "false")
			{
				sendEncrypted = false;
				appendTerminalLog(command, "Now the data will not be sent encrypted");
			}
			else
			{
				appendTerminalLog(command, "Wrong parameters");
			}
		}

		// Clear terminal output
		else if(command == "clear")
		{
			$("#terminal-output").html("");
		}

		// Send command
		else
		{
			if(device != "")
			{
				$.post("/terminal/sendCommand", {cmd: command, dev: device, se: sendEncrypted}, function(data) {
					if(data.content != "")
					{
						// :)
						appendTerminalLog(command, data.content);
					}
					else
					{
						// :(
						appendTerminalLog(command, "Internal error");
					}
				});
			}
			else
			{
				appendTerminalLog(command, "First select a device");
			}
		}

		// Terminal queue
		if(terminalBuffer.length < bufferSize)
		{
			terminalBuffer.push(command);
		}
		else
		{
			terminalBuffer.shift();
			terminalBuffer.push(command);
		}
	}
});

// Terminal log
function appendTerminalLog(cmd, msg)
{
	if(voiceEnabled)
	{
		speech.text = msg;
		speechSynthesis.speak(speech);
	}

	// Append
	$("#terminal-output").append(
		"<span>&gt;</span>" +
		"<span style='margin-left:11px;'>" + cmd + "</span>" +
		"<p>" + msg + "</p>"
	);

	// Clear terminal input and scroll
	$(".terminal").animate({ scrollTop: $('.terminal')[0].scrollHeight}, 800);
	$(".terminal-input").val("");
	bufferIndex = 0;
}


// Terminal buffer usage
$(".terminal-input").focus(function()
{
	$(".terminal-input").keyup(function(e)
	{
		e.stopImmediatePropagation();
		if(e.keyCode == 38)
		{
			if(bufferIndex+1 <= terminalBuffer.length)
			{
				bufferIndex++;
				$(".terminal-input").val(terminalBuffer[terminalBuffer.length - bufferIndex]);
			}
			console.log('bi: ' + bufferIndex);
		}
		else if(e.keyCode == 40)
		{
			if(bufferIndex-1 > 0)
			{
				bufferIndex--;
				$(".terminal-input").val(terminalBuffer[terminalBuffer.length - bufferIndex]);
			}
			console.log('bi: ' + bufferIndex);
		}
	});
});


// Terminal resize
$(".terminal").swipe
({
	threshold: 100,
	tap: function(){},
	doubleTap: function()
	{
		$(".terminal-input").focus();
    },
	swipe: function(event, direction, distance, duration, fingerCount)
	{
		if(direction == "right")
		{
			this.height(this.height() + distance / 15);
		}
		else if((direction == "left") && (this.height() - distance / 15 >= 100))
		{
			this.height(this.height() - distance / 15);
		}
	}
});


// iCheck
$('#enable-voice').iCheck({
	checkboxClass: 'icheckbox_square-blue'
});

$('#enable-voice').on('ifChecked', function(event){
	voiceEnabled = true;
	annyang.start();
});

$('#enable-voice').on('ifUnchecked', function(event){
	voiceEnabled = false;
	annyang.abort();
});


// Voice speech
var voiceEnabled = false;
var speech = new SpeechSynthesisUtterance();
var voices = window.speechSynthesis.getVoices();
speech.voice = voices[10]; // Note: some voices don't support altering params
speech.voiceURI = 'native';
speech.volume = 1; // 0 to 1
speech.rate = 1; // 0.1 to 10
speech.pitch = 2; //0 to 2
speech.lang = 'en-US';


// Select
$('select').selectpicker();


// Data table
var table_shared = $('#shared-data-table').DataTable();
var table_device = $('#device-data-table').DataTable();
var table_voice_commands = $('#voice-commands-table').DataTable();


// Debug
if(!!window.chrome)
{
	Object.observe(terminalBuffer, function(changes)
	{
		changes.forEach(function(change)
		{
			console.log(change);
		});
	});
}


// Add device
$("#form-device-add").submit(function(event) {
	event.preventDefault();
	$.post("/device/add", $("#form-device-add").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			$('#add-device-alert-info, #add-device-alert-error').fadeOut('fast', function(){
				$('#add-device-alert-success').fadeIn('slow');
			});
		}
		else if(data.code == "1")
		{
			// :/
			$('#add-device-alert-success, #add-device-alert-error').fadeOut('fast', function(){
				$('#add-device-alert-info').fadeIn('slow');
			});
		}
		else
		{
			// :(
			$('#add-device-alert-success, #add-device-alert-info').fadeOut('fast', function(){
				$('#add-device-alert-error').fadeIn('slow');
			});
		}
	});
});


// Delete device
$("#form-device-delete").submit(function(event) {
	event.preventDefault();
	if($('#form-device-delete select').val() != 'default-value')
	{
		$.post("/device/delete", $("#form-device-delete").serialize(), function(data) {
			if(data.code == "0")
			{
				// :)
				$('#delete-device-alert-info, delete-device-alert-error').fadeOut('fast', function(){
					$('#delete-device-alert-success').fadeIn('slow');
				});
			}
			else if(data.code == "1")
			{
				// :/
				$('#delete-device-alert-success, delete-device-alert-error').fadeOut('fast', function(){
					$('#delete-device-alert-info').fadeIn('slow');
				});
			}
			else
			{
				// :(
				$('#delete-device-alert-success, #delete-device-alert-info').fadeOut('fast', function(){
					$('#delete-device-alert-error').fadeIn('slow');
				});
			}
		});
	}
});


// Set device connectivity
$("#form-device-connectivity").submit(function(event) {
	event.preventDefault();
	if($('#form-device-connectivity select').val() != 'default-value')
	{
		$.post("/device/connectivity", $("#form-device-connectivity").serialize(), function(data) {
			if(data.code == "0")
			{
				// :)
				$('#conectivity-device-alert-info, #conectivity-device-alert-error').fadeOut('fast', function(){
					$('#conectivity-device-alert-success').fadeIn('slow');
				});
			}
			else if(data.code == "1")
			{
				// :/
				$('#conectivity-device-alert-success, #conectivity-device-alert-error').fadeOut('fast', function(){
					$('#conectivity-device-alert-info').fadeIn('slow');
				});
			}
			else
			{
				// :(
				$('#conectivity-device-alert-success, #conectivity-device-alert-info').fadeOut('fast', function(){
					$('#conectivity-device-alert-error').fadeIn('slow');
				});
			}
		});
	}
});


// Set key
$("#form-settings-key").submit(function(event) {
	event.preventDefault();
	$.post("/settings/key", $("#form-settings-key").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			$('#settings-key-alert-error').fadeOut('fast', function(){
				$('#settings-key-alert-success').fadeIn('slow');
			});
		}
		else
		{
			// :(
			$('#settings-key-alert-success').fadeOut('fast', function(){
				$('#settings-key-alert-error').fadeIn('slow');
			});
		}
	});
});


// Get quick data
$("#form-data-quick").submit(function(event) {
	event.preventDefault();
	$.post("/device/quick-data", $("#form-data-quick").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			if(data.content == '')
			{
				$('#data-quick-result').text('Without data to show :(');
			}
			else
			{
				$('#data-quick-result').text(data.content);
			}
		}
		else
		{
			// :(
			$('#data-quick-result').text('Internal error');
		}
	});
});


// Get shared data
$("#form-data-shared").submit(function(event) {
	event.preventDefault();
	$.post("/device/shared-data", $("#form-data-shared").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			table_shared.clear().draw();
			$.each(data.content, function(i){
				table_shared.row.add([data.content[i].date, data.content[i].value]).draw();
			});
		}
		else
		{
			// :(
			console.log('Internal error');
		}
	});
});


//Get device data
$("#form-data-device").submit(function(event) {
	event.preventDefault();
	$.post("/device/device-data", $("#form-data-device").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			table_device.clear().draw();
			$.each(data.content, function(i){
				table_device.row.add([data.content[i].tag, data.content[i].date, data.content[i].value]).draw();
			});
		}
		else
		{
			// :(
			console.log('Internal error');
		}
	});
});

// Add RTV
$("#form-settings-rtv-add").submit(function(event) {
	event.preventDefault();
	$.post("/rtv/add", $("#form-settings-rtv-add").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			$('#settings-rtv-add-alert-info, #settings-rtv-add-alert-error').fadeOut('fast', function(){
				$('#settings-rtv-add-alert-success').fadeIn('slow');
			});
		}
		else if(data.code == "1")
		{
			// :/
			$('#settings-rtv-add-alert-success, #settings-rtv-add-alert-error').fadeOut('fast', function(){
				$('#settings-rtv-add-alert-info').fadeIn('slow');
			});
		}
		else
		{
			// :(
			$('#settings-rtv-add-alert-success, #settings-rtv-add-alert-info').fadeOut('fast', function(){
				$('#settings-rtv-add-alert-error').fadeIn('slow');
			});
		}
	});
});

// Delete RTV
$("#form-settings-rtv-delete").submit(function(event) {
	event.preventDefault();
	if($('#form-settings-rtv-delete select').val() != 'default-value')
	{
		$.post("/rtv/delete", $("#form-settings-rtv-delete").serialize(), function(data) {
			if(data.code == "0")
			{
				// :)
				$('#settings-rtv-delete-alert-info, #settings-rtv-delete-alert-error').fadeOut('fast', function(){
					$('#settings-rtv-delete-alert-success').fadeIn('slow');
				});
			}
			else if(data.code == "1")
			{
				// :/
				$('#settings-rtv-delete-alert-success, #settings-rtv-delete-alert-error').fadeOut('fast', function(){
					$('#settings-rtv-delete-alert-info').fadeIn('slow');
				});
			}
			else
			{
				// :(
				$('#settings-rtv-delete-alert-success, #settings-rtv-delete-alert-info').fadeOut('fast', function(){
					$('#settings-rtv-delete-alert-error').fadeIn('slow');
				});
			}
		});
	}
});

// RTV Notification
$("#form-settings-rtv-notification").submit(function(event) {
	event.preventDefault();
	if($('#form-settings-rtv-notification select').val() != 'default-value')
	{
		$.post("/rtv/notification", $("#form-settings-rtv-notification").serialize(), function(data) {
			if(data.code == "0")
			{
				// :)
				$('#settings-rtv-notification-alert-info, #settings-rtv-notification-alert-error').fadeOut('fast', function(){
					$('#settings-rtv-notification-alert-success').fadeIn('slow');
				});
			}
			else if(data.code == "1")
			{
				// :/
				$('#settings-rtv-notification-alert-success, #settings-rtv-notification-alert-error').fadeOut('fast', function(){
					$('#settings-rtv-notification-alert-info').fadeIn('slow');
				});
			}
			else
			{
				// :(
				$('#settings-rtv-notification-alert-success, #settings-rtv-notification-alert-info').fadeOut('fast', function(){
					$('#settings-rtv-notification-alert-error').fadeIn('slow');
				});
			}
		});
	}
});

// Add voice command
$("#form-voice-command-add").submit(function(event) {
	event.preventDefault();
	$('#command-action-editor-textarea').val(editor.getSession().getValue());
	$.post("/settings/voice-command/add", $("#form-voice-command-add").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			$('#settings-voice-add-alert-info, #settings-voice-add-alert-error').fadeOut('fast', function(){
				$('#settings-voice-add-alert-success').fadeIn('slow');
			});
		}
		else if(data.code == "1")
		{
			// :/
			$('#settings-voice-add-alert-success, #settings-voice-add-alert-error').fadeOut('fast', function(){
				$('#settings-voice-add-alert-info').fadeIn('slow');
			});
		}
		else
		{
			// :(
			$('#settings-voice-alert-success, #settings-voice-alert-info').fadeOut('fast', function(){
				$('#settings-voice-alert-error').fadeIn('slow');
			});
		}
	});
});

// Delete voice command
$("#form-voice-command-delete").submit(function(event) {
	event.preventDefault();
	$.post("/settings/voice-command/delete", $("#form-voice-command-delete").serialize(), function(data) {
		if(data.code == "0")
		{
			// :)
			$('#settings-voice-delete-alert-info, #settings-voice-delete-alert-error').fadeOut('fast', function(){
				$('#settings-voice-delete-alert-success').fadeIn('slow');
			});
		}
		else if(data.code == "1")
		{
			// :/
			$('#settings-voice-delete-alert-success, #settings-voice-delete-alert-error').fadeOut('fast', function(){
				$('#settings-voice-delete-alert-info').fadeIn('slow');
			});
		}
		else
		{
			// :(
			$('#settings-voice-delete-alert-success, #settings-voice-delete-alert-info').fadeOut('fast', function(){
				$('#settings-voice-delete-alert-error').fadeIn('slow');
			});
		}
	});
});


// Voice commands array
var commands = {};

// Fill the voice commands table
$.post("/settings/voice-command", function(data) {

	// Clear the table
	table_voice_commands.clear().draw();

	// Iterate over the json
	$.each(data.content, function(i){

		// Find parameters
		var s = data.content[i].order;
		var re = /(?:^|\W):(\w+)(?!\w)/g, match, parameters = [];
		while (match = re.exec(s)) {
			parameters.push(match[1]);
		}

		// Add the command to the table
		table_voice_commands.row.add([data.content[i].name, data.content[i].order, data.content[i].action]).draw();

		// Add the command to the commands array
		commands[data.content[i].order] = new Function(parameters, "console.log("+ data.content[i].action +");");
	});

	// Voice recognition
	if (annyang)
	{

		// Debug info
		console.info(commands);

		// Set the language
		annyang.setLanguage('es-UY');

		// Add the commands
		annyang.addCommands(commands);
	}
});

// Editor
var editor = ace.edit('command-action-editor');
editor.setTheme('ace/theme/tomorrow_night_eighties');
editor.getSession().setMode('ace/mode/javascript');
editor.session.setUseWorker(false);
editor.setValue('// Write your action here', 0);

// Command selected (table row)
$('#voice-commands-table tbody').on( 'click', 'tr', function () {
	if ($(this).hasClass('selected') ) {
        $(this).removeClass('selected');
    }
    else {
        table_voice_commands.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }
	$('#input-delete-device').val(table_voice_commands.row(this).data()[0]);
});


});
