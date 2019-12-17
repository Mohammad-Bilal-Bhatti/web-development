const electron = require('electron');
const url = require('url');
const path = require('path');

// De-structuring..
const {app, BrowserWindow, Menu} = electron;

// Empty Menu Templet - means no-menu
const mainMenuTemplet = [
];
// Creating main Menu From that templet.
const mainMenu = Menu.buildFromTemplate(mainMenuTemplet);
Menu.setApplicationMenu(mainMenu);

var mainWindow;

app.on('ready', function(){
	// Creating new Window.
	mainWindow = new BrowserWindow({
		width: 800,
		height: 600
	});

	// Loading HTML into the window.
	mainWindow.loadURL(url.format({
		pathname: path.join(__dirname, 'index.html'),
		protocol: 'file:',
		slashes: true
	}));


});


