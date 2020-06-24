$(function () {
    //内容要素はJSONオブジェクトである、サーバ側加工しフロントに渡すもの
    var elements = {
        nodes: [
            //グラフの点、ノードのidが必須で、他の属性は機能によって調整するばよい
            // { data: { id: '172', name: 'Tom Cruise', label: 'Person' } },
            // { data: { id: '183', title: 'Top Gun', label: 'Movie' } },
            { data: { id: '1', name: 'アルファ', label: 'Person' } },
            { data: { id: '2', name: 'ブラボー', label: 'Person' } },
            { data: { id: '3', name: 'チャーリー', label: 'Person' } },
            { data: { id: '4', name: 'デルタ', label: 'Person' } },
            { data: { id: '5', name: 'エコー', label: 'Person' } },
            { data: { id: '6', name: 'フォックス', label: 'Person' } },
            { data: { id: '7', name: 'ゴルフ', label: 'Person' } },
            { data: { id: '8', name: 'ホテル', label: 'Person' } },
        ],
        edges: [
            //グラフの線、エッジはsource(開始点id)とtarget(終了点id)は必須で、他の属性も追加可能
            // { data: { source: '172', target: '183', relationship: 'Acted_In' } },
            { data: { source: '1', target: '2', relationship: '契約チューター' } },
            { data: { source: '1', target: '5', relationship: '生徒' } },
            { data: { source: '1', target: '6', relationship: '生徒' } },
            { data: { source: '2', target: '1', relationship: '雇用主' } },
            { data: { source: '2', target: '5', relationship: '生徒' } },
            { data: { source: '2', target: '6', relationship: '生徒' } },
            { data: { source: '3', target: '4', relationship: '契約チューター' } },
            { data: { source: '3', target: '7', relationship: '生徒' } },
            { data: { source: '3', target: '8', relationship: '生徒' } },
            { data: { source: '4', target: '3', relationship: '雇用主' } },
            { data: { source: '4', target: '7', relationship: '生徒' } },
            { data: { source: '4', target: '8', relationship: '生徒' } },
            { data: { source: '5', target: '1', relationship: '先生' } },
            { data: { source: '5', target: '2', relationship: 'チューター' } },
            { data: { source: '6', target: '1', relationship: '先生' } },
            { data: { source: '6', target: '2', relationship: 'チューター' } },
            { data: { source: '7', target: '3', relationship: '先生' } },
            { data: { source: '7', target: '4', relationship: 'チューター' } },
            { data: { source: '8', target: '3', relationship: '先生' } },
            { data: { source: '8', target: '4', relationship: 'チューター' } },
        ],
    }

    //内容要素を表現するCSS
    var style = [
        //セレクターで拾いた内容要素が 指定したCSSを適用する
        //ノードの中で、label属性は「Peson」のノードが青色で表示し、文字はname属性を表示する
        {
            selector: 'node[label = "Person"]',
            css: {
                'background-color': '#6FB1FC',
                'content': 'data(name)'
            }
        },
        //ノードの中で、label属性は「Movie」のノードがオレンジ色で表示し、文字はtitle属性を表示する
        {
            selector: 'node[label = "Movie"]',
            css: {
                'background-color': '#F5A45D',
                'content': 'data(title)'
            }
        },
        //エッジ全体で、文字はrelationship属性を表示する、終了点での矢印は三角形にする
        {
            selector: 'edge',
            css: {
                'content': 'data(relationship)',
                'target-arrow-shape': 'triangle',
                'curve-style': 'unbundled-bezier'
            }
        }
    ]

    //レイアウト設定
    var layout = {
        //グリッドレイアウトを適用する
        // name: 'fcose',
        // name: 'grid',
        // name: 'random',
        // name: 'circle',
        // name: 'concentric',
        name: 'breadthfirst',
        // name: 'cose',
        // name: 'Edge-weighted Spring Embedded',


    }

    // Cytoscapeオブジェクト初期化。
    var cy = cytoscape({
        // containerがHTML内の「cy」DOM要素に指定
        container: document.getElementById('cy'),
        elements: elements,
        style: style,
        layout: layout,
    });
});
