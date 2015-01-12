/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};
var opts = {
    'gAudioPreloadPreference': 'auto',

    'gVideoPreloadPreference': 'auto'
};
var resources = [
];
var symbols = {
"stage": {
    version: "4.0.0",
    minimumCompatibleVersion: "4.0.0",
    build: "4.0.0.359",
    baseState: "Base State",
    scaleToFit: "width",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
            {
                id: 'Group',
                type: 'group',
                rect: ['31', '50','1106','378','auto', 'auto'],
                c: [
                {
                    id: 'Lincat',
                    type: 'image',
                    rect: ['0px', '18px','241px','360px','auto', 'auto'],
                    fill: ["rgba(0,0,0,0)",im+"Lincat.png",'0px','0px']
                },
                {
                    id: 'Rectangle1',
                    type: 'rect',
                    rect: ['309px', '80px','531px','50px','auto', 'auto'],
                    fill: ["rgba(192,192,192,1)"],
                    stroke: [0,"rgb(0, 0, 0)","none"],
                    c: [
                    {
                        id: 'Text1',
                        type: 'text',
                        rect: ['7px', '7px','auto','auto','auto', 'auto'],
                        text: "Hi Taylor",
                        align: "left",
                        font: ['Trebuchet MS, Arial, Helvetica, sans-serif', 24, "rgba(0,0,0,1)", "700", "none", "normal"]
                    }]
                },
                {
                    id: 'Rectangle',
                    type: 'rect',
                    rect: ['293px', '0px','531px','50px','auto', 'auto'],
                    fill: ["rgba(192,192,192,1)"],
                    stroke: [0,"rgb(0, 0, 0)","none"],
                    c: [
                    {
                        id: 'Text',
                        type: 'text',
                        rect: ['2px', '7px','576px','auto','auto', 'auto'],
                        text: "Red Hot Chilli Catering Equipment",
                        align: "left",
                        font: ['Trebuchet MS, Arial, Helvetica, sans-serif', 24, "rgba(0,0,0,1)", "700", "none", "normal"]
                    }]
                }]
            },
            {
                id: 'GroupCopy',
                type: 'group',
                rect: ['31px', '50px','1106px','378px','auto', 'auto'],
                c: [
                {
                    id: 'Rectangle1Copy',
                    type: 'rect',
                    rect: ['309px', '80px','531px','50px','auto', 'auto'],
                    fill: ["rgba(192,192,192,1)"],
                    stroke: [0,"rgb(0, 0, 0)","none"],
                    c: [
                    {
                        id: 'Text1Copy',
                        type: 'text',
                        rect: ['7px', '7px','auto','auto','auto', 'auto'],
                        text: "Contact us today to get a great deal!<br>",
                        align: "left",
                        font: ['Trebuchet MS, Arial, Helvetica, sans-serif', 24, "rgba(0,0,0,1)", "700", "none", "normal"]
                    }]
                },
                {
                    id: 'RectangleCopy',
                    type: 'rect',
                    rect: ['293px', '0px','531px','50px','auto', 'auto'],
                    fill: ["rgba(192,192,192,1)"],
                    stroke: [0,"rgb(0, 0, 0)","none"],
                    c: [
                    {
                        id: 'TextCopy',
                        type: 'text',
                        rect: ['2px', '7px','576px','auto','auto', 'auto'],
                        text: "Proffessional Catering equipment at sensible prices",
                        align: "left",
                        font: ['Trebuchet MS, Arial, Helvetica, sans-serif', 24, "rgba(0,0,0,1)", "700", "none", "normal"]
                    }]
                },
                {
                    id: 'blue_seal',
                    type: 'image',
                    rect: ['0px', '22px','241px','241px','auto', 'auto'],
                    fill: ["rgba(0,0,0,0)",im+"blue%20seal.png",'0px','0px']
                }]
            }],
            symbolInstances: [

            ]
        },
    states: {
        "Base State": {
            "${_Text1}": [
                ["style", "top", '7px'],
                ["style", "font-weight", '700'],
                ["style", "font-family", 'Trebuchet MS, Arial, Helvetica, sans-serif'],
                ["style", "left", '7px'],
                ["style", "font-size", '24px']
            ],
            "${_Text1Copy}": [
                ["style", "top", '7px'],
                ["style", "font-weight", '700'],
                ["style", "font-family", 'Trebuchet MS, Arial, Helvetica, sans-serif'],
                ["style", "left", '7px'],
                ["style", "font-size", '24px']
            ],
            "${_Lincat}": [
                ["style", "top", '310px'],
                ["style", "height", '360px'],
                ["style", "left", '0px'],
                ["style", "width", '241px']
            ],
            "${_Rectangle1}": [
                ["style", "top", '80px'],
                ["style", "height", '44px'],
                ["color", "background-color", 'rgba(192,192,192,0.75)'],
                ["style", "left", '935px'],
                ["style", "width", '530px']
            ],
            "${_Rectangle1Copy}": [
                ["style", "top", '80px'],
                ["style", "height", '44px'],
                ["color", "background-color", 'rgba(192,192,192,0.75)'],
                ["style", "left", '935px'],
                ["style", "width", '530px']
            ],
            "${_Group}": [
                ["style", "left", '31px']
            ],
            "${_blue_seal}": [
                ["style", "top", '381px'],
                ["style", "height", '241px'],
                ["style", "left", '0px'],
                ["style", "width", '241px']
            ],
            "${_Text}": [
                ["style", "top", '7px'],
                ["style", "width", 'auto'],
                ["style", "font-weight", '700'],
                ["style", "font-family", 'Trebuchet MS, Arial, Helvetica, sans-serif'],
                ["style", "left", '2px'],
                ["style", "font-size", '24px']
            ],
            "${_GroupCopy}": [
                ["style", "left", '31px']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(0,0,0,1.00)'],
                ["style", "overflow", 'hidden'],
                ["style", "height", '360px'],
                ["gradient", "background-image", [50,90,true,'farthest-corner',[['rgba(102,102,102,1.00)',0],['rgba(17,17,17,1.00)',70]]]],
                ["style", "width", '960px']
            ],
            "${_Rectangle}": [
                ["style", "top", '0px'],
                ["style", "height", '44px'],
                ["color", "background-color", 'rgba(192,192,192,0.75)'],
                ["style", "left", '935px'],
                ["style", "width", '636px']
            ],
            "${_TextCopy}": [
                ["style", "top", '7px'],
                ["style", "font-size", '24px'],
                ["style", "font-weight", '700'],
                ["style", "font-family", 'Trebuchet MS, Arial, Helvetica, sans-serif'],
                ["style", "left", '2px'],
                ["style", "width", 'auto']
            ],
            "${_RectangleCopy}": [
                ["style", "top", '0px'],
                ["style", "height", '44px'],
                ["color", "background-color", 'rgba(192,192,192,0.75)'],
                ["style", "left", '935px'],
                ["style", "width", '636px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 20000,
            autoPlay: true,
            labels: {
                "loop": 0
            },
            timeline: [
                { id: "eid14", tween: [ "style", "${_Rectangle1}", "left", '399px', { fromValue: '935px'}], position: 3250, duration: 500, easing: "easeOutBack" },
                { id: "eid42", tween: [ "style", "${_RectangleCopy}", "left", '293px', { fromValue: '935px'}], position: 12500, duration: 500, easing: "easeOutBack" },
                { id: "eid30", tween: [ "style", "${_Group}", "left", '-1106px', { fromValue: '31px'}], position: 9250, duration: 750, easing: "easeInOutBack" },
                { id: "eid45", tween: [ "style", "${_blue_seal}", "top", '22px', { fromValue: '381px'}], position: 10500, duration: 1500, easing: "easeOutElastic" },
                { id: "eid13", tween: [ "style", "${_Rectangle}", "left", '293px', { fromValue: '935px'}], position: 2500, duration: 500, easing: "easeOutBack" },
                { id: "eid43", tween: [ "style", "${_Rectangle1Copy}", "left", '399px', { fromValue: '935px'}], position: 13250, duration: 500, easing: "easeOutBack" },
                { id: "eid41", tween: [ "style", "${_GroupCopy}", "left", '-1106px', { fromValue: '31px'}], position: 19250, duration: 750, easing: "easeInOutBack" },
                { id: "eid11", tween: [ "style", "${_Lincat}", "top", '18px', { fromValue: '310px'}], position: 500, duration: 1500, easing: "easeOutElastic" }            ]
        }
    }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources, opts);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-18860992");
