<template>
	<div>
		<h1>Regions</h1>

		<div class="input-icon">
			<i class="icon-magnifier" @click="searchKeyword()" />
			<input
				v-model="searchText"
				type="text"
				class="form-control"
				placeholder="Search..."
				@keyup.enter="searchKeyword()"
			>
		</div>

		<v-jstree :data="tree" :draggable="true" @item-drop="onDrop" ref="tree">
			<template slot-scope="_">
				<div class="role_node" v-bind:id="_.model.id">

					{{_.model.text}}

		            <a v-if="_.model.id !== 0" :href="link_route(regionRoute, _.model.id)" class="btn btn-xs blue btn-outline">
		            	<i class="fa fa-pencil" />
		            </a>

		            <button v-if="_.model.id !== 0" type="button" class="btn btn-xs red btn-outline" @click="deleteNode(_.vm, _.model, $event)">
		            	<i class="fa fa-trash" />
		            </button>

				</div>
			</template>
		</v-jstree>

		<button type="button" @click="sync()">Save All</button>

	</div>
</template>

<script>
	import VJstree from 'vue-jstree';

    export default {
    	props: ['regionRoute'],
		components: {
			VJstree,
		},
        mounted() {

        },
        created() {
            this.fetchRegions();
        },
        data() {
            return {
				tree: [
					{
						id           : 0,
						text         : "World",
						value        : "root",
						icon         : "",
						opened       : true,
						selected     : false,
						disabled     : false,
						loading      : false,
						children     : [],
						dragDisabled : true
					}
				],
				tally: [],
				searchText: '',
            }
        },
        methods: {
			searchKeyword ()
			{
				var text   = this.searchText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
				const patt = new RegExp(text);

				this.$refs.tree.handleRecursionNodeChilds(this.$refs.tree, function (node) {

					if (text !== '' && node.model !== undefined) 
					{
						const str = node.model.text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");

						if (patt.test(str)) 
						{
							node.$el.querySelector('.tree-anchor').style.backgroundColor = 'yellow';
						} 
						else 
						{
							node.$el.querySelector('.tree-anchor').style.backgroundColor = '';
						}
					} 
					else 
					{
						node.$el.querySelector('.tree-anchor').style.backgroundColor = '';
					}
				});
			},
            fetchRegions() 
            {
                fetch('api/region')
                    .then(res => res.json())
                    .then(res => {
                        this.tree[0].children = res;
                    })
                    .catch(err => console.error(err));
            },
            onDrop()
            {

            },
            sync()
            {
				var regions = $('div.role_node#0').closest('li').find('li');

				this.tally = [];
				this.getNode(regions);

				fetch('api/region/rearrange', {
					method: 'post',
					body: JSON.stringify(this.tally),
					headers: {
						'content-type' : 'application/json'
					}
				})
					.then(res => {
						window.location.href = this.regionRoute;
					})
					.catch(err => console.error(err));

            },  
		    getNode(node)
		    {
				var that = this;

				if (node.length > 0)
				{
					if (node.length > 1)
					{
						node.each(function( index, value ) {
							return that.getNode($(this));
						});
					}
					else
					{
						this.tally.push({role_id: node.find('div.role_node').attr('id'), parent_id: node.parent().closest('li').find('div.role_node').attr('id')});

						return;
					}
				}
		    },
		    deleteNode: function (node ,item, e) 
		    {
				e.stopPropagation();
				var index = node.parentItem.indexOf(item);
				var res   = node.parentItem.splice(index, 1);
		    },
		    link_route: function (name, id)
		    {
		    	return name + '/' + id + '/edit';
		    },
        }
    }
</script>