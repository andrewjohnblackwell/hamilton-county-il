(function (wp) {
    'use strict';
    
    // Plugin loaded successfully
    
    // Check if required dependencies exist
    if (!wp || !wp.plugins || (!wp.editor && !wp.editPost)) {
        console.error('Split Department Editor: Missing required WordPress dependencies!');
        console.log('Available wp keys:', wp ? Object.keys(wp) : 'wp is undefined');
        return;
    }
    
    const { registerPlugin } = wp.plugins;
    // WordPress 6.6+ uses wp.editor.PluginSidebar instead of wp.editPost.PluginSidebar
    const { PluginSidebar } = wp.editor || wp.editPost;
    const { PanelBody, Button, SelectControl, TextControl, ToggleControl, Notice, Spinner } = wp.components;
    const { Fragment, useState } = wp.element;
    const { select } = wp.data;
    const apiFetch = wp.apiFetch;
    const { __ } = wp.i18n;
    
    const DepartmentSplitter = () => {
        const post = select('core/editor').getCurrentPost();
        const postId = post?.id;

        const [status, setStatus] = useState('publish');
        const [prefix, setPrefix] = useState('');
        const [level, setLevel] = useState('2');
        const [replaceParent, setReplace] = useState(true);
        const [busy, setBusy] = useState(false);
        const [msg, setMsg] = useState(null);
        const [err, setErr] = useState(null);

        const run = async () => {
            setErr(null); 
            setMsg(null);
            if (!postId) { 
                setErr('No department ID found.'); 
                return; 
            }

            if (!confirm('Split this department into sub-departments? This will create new department pages and may replace the parent content with a table of contents.')) {
                return;
            }

            try {
                setBusy(true);
                const res = await apiFetch({
                    url: window.SplitDepartment.restUrl,
                    method: 'POST',
                    headers: { 'X-WP-Nonce': window.SplitDepartment.nonce },
                    data: {
                        postId: postId,
                        status: status,
                        prefix: prefix,
                        headingLevel: parseInt(level, 10),
                        replaceParent: !!replaceParent
                    }
                });
                const replaced = res?.replacedParent ? 'Parent department updated with table of contents.' : '';
                setMsg(`Created ${res?.created ?? 0} sub-department(s). ${replaced}`);
            } catch (e) {
                setErr(e?.message || 'Error splitting department.');
            } finally {
                setBusy(false);
            }
        };

        return wp.element.createElement(
            PluginSidebar,
            { 
                name: 'split-into-departments',
                title: 'Split Into Sub-Departments',
                icon: 'networking'
            },
            wp.element.createElement(
                PanelBody,
                { title: 'Split Options', initialOpen: true },
                wp.element.createElement(SelectControl, {
                    label: 'Create sub-departments as',
                    value: status,
                    options: [
                        { label: 'Published', value: 'publish' },
                        { label: 'Draft', value: 'draft' },
                    ],
                    onChange: setStatus
                }),
                wp.element.createElement(TextControl, {
                    label: 'Title prefix (optional)',
                    value: prefix,
                    onChange: setPrefix,
                    placeholder: 'e.g., Sub-Department: ',
                    help: 'This prefix will be added to each sub-department title.'
                }),
                wp.element.createElement(SelectControl, {
                    label: 'Split at heading level',
                    value: level,
                    options: [
                        { label: 'H2 (Heading 2)', value: '2' },
                        { label: 'H3 (Heading 3)', value: '3' },
                        { label: 'H4 (Heading 4)', value: '4' },
                    ],
                    onChange: setLevel,
                    help: 'Department content will be split at this heading level.'
                }),
                wp.element.createElement(ToggleControl, {
                    label: 'Replace parent content with sub-department links',
                    checked: replaceParent,
                    onChange: setReplace,
                    help: 'If enabled, the parent department content will be replaced with a list of links to the new sub-departments.'
                }),
                wp.element.createElement(
                    'div',
                    { style: { marginTop: 16 } },
                    wp.element.createElement(Button, {
                        isPrimary: true,
                        isBusy: busy,
                        disabled: busy,
                        onClick: run
                    }, busy ? 'Splitting Department…' : 'Split into Sub-Departments'),
                    busy && wp.element.createElement(Spinner, { style: { marginLeft: 8 } })
                )
            ),
            msg && wp.element.createElement(Notice, {
                status: 'success',
                isDismissible: true,
                onRemove: () => setMsg(null)
            }, msg),
            err && wp.element.createElement(Notice, {
                status: 'error',
                isDismissible: true,
                onRemove: () => setErr(null)
            }, err),
            wp.element.createElement(
                PanelBody,
                { title: 'How it works', initialOpen: false },
                wp.element.createElement('p', {}, 'This tool detects headings in your department content and creates sub-departments for each section at the chosen heading level.'),
                wp.element.createElement('ul', { style: { paddingLeft: 20, marginTop: 10, listStyle: 'disc' } },
                    wp.element.createElement('li', { style: { marginBottom: 8 } },
                        wp.element.createElement('strong', {}, 'Block Editor:'), ' Splits by heading blocks at the selected level.'
                    ),
                    wp.element.createElement('li', { style: { marginBottom: 8 } },
                        wp.element.createElement('strong', {}, 'Classic Editor:'), ' Splits by HTML heading tags (e.g., <h2>).'
                    ),
                    wp.element.createElement('li', { style: { marginBottom: 8 } },
                        wp.element.createElement('strong', {}, 'Ordering:'), ' Sub-departments are ordered by their appearance in the content.'
                    )
                ),
                wp.element.createElement('p', { style: { marginTop: 12, fontStyle: 'italic' } },
                    'Note: Make sure your department content has clear heading structures before splitting.'
                )
            ),
            wp.element.createElement(
                PanelBody,
                { title: 'Tips', initialOpen: false },
                wp.element.createElement('ul', { style: { paddingLeft: 20, listStyle: 'disc' } },
                    wp.element.createElement('li', { style: { marginBottom: 8 } }, 'Use consistent heading levels for better organization.'),
                    wp.element.createElement('li', { style: { marginBottom: 8 } }, 'Review the created sub-departments after splitting to ensure they have appropriate content.'),
                    wp.element.createElement('li', { style: { marginBottom: 8 } }, 'You can always manually edit or delete sub-departments after creation.'),
                    wp.element.createElement('li', { style: { marginBottom: 8 } }, 'The parent department will show a list of sub-departments if you enable "Replace parent content".')
                )
            )
        );
    };

    registerPlugin('split-into-departments', { 
        render: DepartmentSplitter,
        icon: 'networking'
    });
    
})(window.wp);
